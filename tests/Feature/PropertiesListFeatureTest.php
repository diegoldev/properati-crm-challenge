<?php

namespace Tests\Feature;

use App\Models\PropertiesModel;
use Exception;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertiesListFeatureTest extends TestCase
{
    use RefreshDatabase;
    use withFaker;

    public function testPropertiesAreListedProperlyWithoutFilters(): void
    {
        $propertiesQuantity = 4;
        PropertiesModel::factory()->count($propertiesQuantity)->create();
        $response = $this->get(route('properties.index'));
        $response->assertJsonCount($propertiesQuantity);
        $response->assertOk();
    }

    /**
     * @throws Exception
     */
    public function testPropertiesAreFilteredProperlyByPropertyType(): void
    {
        $expectedFilteredResults = 2;
        $filteredValue = 9;
        PropertiesModel::factory()->count($expectedFilteredResults)->create(['property_type->id' => $filteredValue]);
        PropertiesModel::factory()->count(random_int(1, 5))->create(['property_type->id' => random_int(10, 100)]);
        $response = $this->get(route('properties.index')."?property_type_id=$filteredValue");
        $response->assertJsonCount($expectedFilteredResults);
        $response->assertOk();
    }

    /**
     * @throws Exception
     */
    public function testPropertiesAreFilteredProperlyByTransactionType(): void
    {
        $expectedFilteredResults = 4;
        $filteredValue = 1;
        PropertiesModel::factory()->count($expectedFilteredResults)->create(['transaction_type->id' => $filteredValue]);
        PropertiesModel::factory()->count(random_int(1, 4))->create(['transaction_type->id' => random_int(2, 100)]);
        $response = $this->getJson(route('properties.index')."?transaction_type_id=$filteredValue");
        $response->assertJsonCount($expectedFilteredResults);
        $response->assertOk();
    }

    /**
     * @throws Exception
     */
    public function testPropertiesAreFilteredProperlyByPriceRange(): void
    {
        $expectedFilteredResults = 8;
        $filteredMinPrice = 110100;
        $filteredMaxPrice = 299199;
        PropertiesModel::factory()->count($expectedFilteredResults)->create(['price' => random_int(100001, 300000)]);
        PropertiesModel::factory()->count(random_int(1, 4))->create(['price' => random_int(1, 100000)]);
        $response = $this->getJson(route('properties.index')."?min_price=$filteredMinPrice&max_price=$filteredMaxPrice");
        $response->assertJsonCount($expectedFilteredResults);
        $response->assertOk();
    }

    /**
     * @throws Exception
     */
    public function testPropertiesAreFilteredProperlyByText(): void
    {
        $expectedFilteredResults = 2;
        $filteredValue = "Foo bar";
        PropertiesModel::factory()->count($expectedFilteredResults)->create(['title' => $filteredValue]);
        PropertiesModel::factory()->count(random_int(1, 4))->create(['title' => $this->faker->sentence]);
        $response = $this->getJson(route('properties.index')."?text=$filteredValue");
        $response->assertJsonCount($expectedFilteredResults);
        $response->assertOk();
    }

    public function testPropertyIsShowProperly(): void
    {
        $property = PropertiesModel::factory()->create();
        $response = $this->getJson(route('properties.show', [$property->id]));
        $response->assertOk();
        self::assertSame($response->json('id'), $property->id);
        self::assertSame($response->json('title'), $property->title);
    }
    /**
     * @TODO: More tests should be implemented in order to incremente code coverage and more use cases
     */
}
