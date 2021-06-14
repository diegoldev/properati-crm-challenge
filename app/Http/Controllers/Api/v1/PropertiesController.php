<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return PropertiesModel[]|\Illuminate\Database\Eloquent\Collection|Response
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'property_type_id' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'transaction_type_id' => ['nullable', 'integer', 'min:1', 'max:2'],
            'min_price' => ['nullable', 'integer', 'min:0', 'max:999999999'],
            'max_price' => ['nullable', 'integer', 'min:0', 'max:999999999'],
            'text' => ['nullable', 'string', 'min:0', 'max:100'],
        ]);
        $queryBuilder = PropertiesModel::query();
        if ($propertyTypeId = $validatedData['property_type_id'] ?? null) {
            $queryBuilder->where('property_type->id', $propertyTypeId);
        }
        if ($transactionTypeId = $validatedData['transaction_type_id'] ?? null) {
            $queryBuilder->where('transaction_type->id', $transactionTypeId);
        }
        if ($minPrice = $validatedData['min_price'] ?? null) {
            $queryBuilder->where('price', '>=', $minPrice);
        }
        if ($maxPrice = $validatedData['max_price'] ?? null) {
            $queryBuilder->where('price', '<=', $maxPrice);
        }
        if ($text = $validatedData['text'] ?? null) {
            $queryBuilder->where(static function (Builder $query) use ($text) {
                //@TODO: habría que configurar el motor o las búsquedas para que sean incase-sensitive
                $query->where('title', 'like', "%$text%")
                    ->orWhere('neighborhood', 'like', "%$text%")
                    ->orWhere('address', 'like', "%$text%")
                    ->orWhere('city->name', 'like', "%$text%")
                    ->orWhere('state->name', 'like', "%$text%")
                    ->orWhereJsonContains('payment', $text)
                    ->orWhereJsonContains('tags', $text);
            });
        }
        return $queryBuilder->get();
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return PropertiesModel|PropertiesModel[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Response
     */
    public function show($id)
    {
        return PropertiesModel::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'status' => ['required', 'in:available,rented,closed']
        ]);
        $propertyToUpdate = PropertiesModel::findOrFail($id);
        $propertyToUpdate->status = $validatedData['status'];
        $saved = $propertyToUpdate->save();
        $propertyToUpdate->refresh();
        return \response()->json(['data' => $propertyToUpdate, 'saved' => $saved]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $propertyToDelete = PropertiesModel::findOrFail($id);
        $deleted = $propertyToDelete->delete();
        return \response()->json(['deleted' => $deleted]);
    }
}
