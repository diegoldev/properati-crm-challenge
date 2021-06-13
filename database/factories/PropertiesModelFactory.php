<?php

namespace Database\Factories;

use App\Models\PropertiesModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertiesModelFactory extends Factory
{
    protected $model = PropertiesModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $txTypeID = $this->faker->randomNumber();
        $txTypeName = $txTypeID === 1 ? 'alquiler' : 'venta';
        return [
            "id" => $this->faker->numberBetween(1, 200000),
            "title" => $this->faker->sentence(3),
            "property_type" => [
                'id' => $this->faker->numberBetween(1, 100),
                'name' => $this->faker->words(3, true),
            ],
            "transaction_type" => [
                'id' => $txTypeID,
                'name' => $txTypeName,
            ],
            "currency" => [
                'id' => $this->faker->numberBetween(1, 100),
                'name' => $this->faker->words(3, true),
            ],
            "address" => $this->faker->address,
            "address_number" => $this->faker->randomNumber(),
            "google_map_data" => [],
            "city" => [
                'id' => $this->faker->numberBetween(1, 100),
                'name' => $this->faker->city,
            ],
            "state" => [
                'id' => $this->faker->numberBetween(1, 100),
                'name' => $this->faker->state,
            ],
            "country" => [
                'id' => $this->faker->numberBetween(1, 100),
                'name' => $this->faker->country,
            ],
            "neighborhood" => $this->faker->words(3, true),
            "rooms" => $this->faker->numberBetween(1, 5),
            "bedrooms" => $this->faker->numberBetween(1, 5),
            "bathrooms" => $this->faker->numberBetween(1, 3),
            "garages" => $this->faker->numberBetween(1, 3),
            "m2" => $this->faker->numberBetween(10, 1000),
            "m2_covered" => $this->faker->numberBetween(10, 1000),
            "year" => $this->faker->year,
            "price" => $this->faker->numberBetween(10000, 100000000),
            "amenities" => [],
            "images" => [],
            "status" => $this->faker->randomElement(['available', 'rented', 'closed']),
            "payment" => $this->faker->words(3),
            "disposition" => $this->faker->words(3),
            "tags" => $this->faker->words(3),
        ];
    }
}
