<?php

namespace Tests\Feature;

use App\Models\PropertiesModel;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PropertiesManagementFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testPropertyStatusIsUpdatedProperlyWithAnAvailableStatus(): void
    {

        $property = PropertiesModel::factory()->create(['status' => 'available']);
        $response = $this->actingAsAuthenticatedUser()->putJson(route('properties.update', [$property->id]), ['status' => 'rented']);
        $response->assertOk();
        self::assertTrue($response->json('saved'));
        self::assertSame($response->json('data')['status'], 'rented');
    }

    public function testPropertyStatusFailsIfSendAnUnavailableStatus(): void
    {
        $property = PropertiesModel::factory()->create(['status' => 'available']);
        $response = $this->actingAsAuthenticatedUser()->putJson(route('properties.update', [$property->id]), ['status' => 'not-available']);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);//422: Validation error code from Laravel
        $resultantProperty = PropertiesModel::select('status')->findOrFail($property->id);
        //Check that status is not updated...
        self::assertSame($resultantProperty->status, 'available');
    }

    public function testPropertyIsDeletedProperly(): void
    {
        $property = PropertiesModel::factory()->create();
        $response = $this->actingAsAuthenticatedUser()->deleteJson(route('properties.destroy', [$property->id]));
        $response->assertOk();
        self::assertTrue($response->json('deleted'));
        //Properties table should be empty after delete the only existing row.
        $this->assertDatabaseCount('properties', 0);

    }

    /**
     * Helper method to perform authentication and send JWT header
     * @return $this
     */
    protected function actingAsAuthenticatedUser(): PropertiesManagementFeatureTest
    {
        $plainPassword = "12345";
        $authUser = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => $plainPassword,
        ]);


        $token = auth('api')->attempt([
            'email' => $authUser->email,
            'password' => $plainPassword
        ]);

        $this->withHeaders(
            array_merge([
                $this->defaultHeaders,
                ['Authorization' => 'Bearer '.$token]
            ])
        );

        return $this;
    }

    /**
     * @TODO: More tests should be implemented in order to incremente code coverage and more use cases
     */
}
