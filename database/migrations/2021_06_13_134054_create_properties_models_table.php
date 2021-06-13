<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('title')->nullable();
            $table->json('property_type')->nullable();
            $table->json('transaction_type')->nullable();
            $table->json('currency')->nullable();
            $table->string('address')->nullable();
            $table->string('address_number')->nullable();
            $table->json('google_map_data')->nullable();
            $table->json('city')->nullable();
            $table->json('state')->nullable();
            $table->json('country')->nullable();
            $table->string('neighborhood')->nullable();
            $table->tinyInteger('rooms')->nullable();
            $table->tinyInteger('bedrooms')->nullable();
            $table->tinyInteger('bathrooms')->nullable();
            $table->tinyInteger('garages')->nullable();
            $table->smallInteger('m2')->nullable();
            $table->smallInteger('m2_covered')->nullable();
            $table->smallInteger('year')->nullable();
            $table->bigInteger('price')->nullable();
            $table->json('amenities')->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['available', 'rented', 'closed']);
            $table->json('payment')->nullable();
            $table->json('disposition')->nullable();
            $table->json('tags')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
