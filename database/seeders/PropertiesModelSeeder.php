<?php

namespace Database\Seeders;

use App\Models\PropertiesModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PropertiesModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        try {

            $jsonData = @file_get_contents(resource_path('sourceData/db.json'));
            $jsonDecodedData = json_decode($jsonData, false, 512, JSON_THROW_ON_ERROR);
            PropertiesModel::truncate();
            foreach ($jsonDecodedData as $oneRow) {
                $newProperty = new PropertiesModel();
                $newProperty->id = $oneRow->id;
                $newProperty->title = $oneRow->title;
                $newProperty->property_type = $oneRow->property_type;
                $newProperty->transaction_type = $oneRow->transaction_type;
                $newProperty->currency = $oneRow->currency;
                $newProperty->address = $oneRow->address;
                $newProperty->address_number = $oneRow->address_number;
                $newProperty->google_map_data = $oneRow->google_map_data;
                $newProperty->city = $oneRow->city;
                $newProperty->state = $oneRow->state;
                $newProperty->country = $oneRow->country;
                $newProperty->neighborhood = $oneRow->neighborhood;
                $newProperty->rooms = $oneRow->rooms;
                $newProperty->bedrooms = $oneRow->bedrooms;
                $newProperty->bathrooms = $oneRow->bathrooms;
                $newProperty->garages = $oneRow->garages;
                $newProperty->m2 = $oneRow->m2;
                $newProperty->m2_covered = $oneRow->m2_covered;
                $newProperty->year = $oneRow->year;
                $newProperty->price = $oneRow->price;
                $newProperty->amenities = $oneRow->amenities;
                $newProperty->images = $oneRow->images;
                $newProperty->status = $oneRow->status;
                $newProperty->payment = $oneRow->payment;
                $newProperty->disposition = $oneRow->disposition;
                $newProperty->tags = $oneRow->tags;
                $newProperty->save();
            }

        } catch (JsonException $jsonException) {
            //@TODO: esto debería ir a un log
            echo "#Error#: Source data cannot be seeded. Error when trying to decode json.".$jsonException->getMessage().PHP_EOL;
            die;
        } catch (Exception $exception) {
            //@TODO: esto debería ir a un log
            echo "#Error#: Source data cannot be seeded. Unexpected error: ".$exception->getMessage().PHP_EOL;
            die;
        }

    }
}
