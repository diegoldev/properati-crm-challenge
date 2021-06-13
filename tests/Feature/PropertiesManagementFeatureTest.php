<?php

namespace Tests\Feature;

use App\Models\PropertiesModel;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertiesManagementFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testPropertyStatusIsUpdatedProperlyWithAnAvailableStatus(): void
    {
        $property = PropertiesModel::factory()->create(['status' => 'available']);
        $response = $this->putJson(route('properties.update', [$property->id]), ['status' => 'rented']);
        $response->assertOk();
        self::assertTrue($response->json('saved'));
        self::assertSame($response->json('data')['status'], 'rented');
    }

    public function testPropertyStatusFailsIfSendAnUnavailableStatus(): void
    {
        $property = PropertiesModel::factory()->create(['status' => 'available']);
        $response = $this->putJson(route('properties.update', [$property->id]), ['status' => 'not-available']);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);//422: Validation error code from Laravel
        $resultantProperty = PropertiesModel::select('status')->findOrFail($property->id);
        //Check that status is not updated...
        self::assertSame($resultantProperty->status, 'available');
    }

    public function testPropertyIsDeletedProperly(): void
    {
        $property = PropertiesModel::factory()->create();
        $response = $this->deleteJson(route('properties.destroy', [$property->id]));
        $response->assertOk();
        self::assertTrue($response->json('deleted'));
        //Properties table should be empty after delete the only existing row.
        $this->assertDatabaseCount('properties', 0);

    }

    public function testPropertyIsShowProperly(): void
    {
        $property = PropertiesModel::factory()->create();
        $response = $this->getJson(route('properties.show', [$property->id]));
        $response->assertOk();
        self::assertSame($response->json('id'), $property->id);
        self::assertSame($response->json('title'), $property->title);
    }
}
