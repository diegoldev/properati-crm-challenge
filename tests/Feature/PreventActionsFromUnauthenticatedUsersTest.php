<?php

namespace Tests\Feature;

use App\Models\PropertiesModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PreventActionsFromUnauthenticatedUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testIsNotPossibleToUpdatePropertyStatusIfUserIsUnauthenticated(): void
    {
        $property = PropertiesModel::factory()->create(['status' => 'available']);
        $response = $this->putJson(route('properties.update', [$property->id]), ['status' => 'rented']);
        $response->assertUnauthorized();
        $resultantProperty = PropertiesModel::select('status')->findOrFail($property->id);
        //Check that status is not updated...
        self::assertSame($resultantProperty->status, 'available');
    }

    public function testIsNotPossibleToDeletePropertyIfUserIsUnauthenticated(): void
    {
        $property = PropertiesModel::factory()->create();
        $response = $this->deleteJson(route('properties.destroy', [$property->id]));
        $response->assertUnauthorized();
        //Properties table should not be empty because nothing should be deleted...
        $this->assertDatabaseCount('properties', 1);
    }
    /**
     * @TODO: More tests should be implemented in order to incremente code coverage and more use cases
     */
}
