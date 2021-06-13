<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'properties';
    protected $casts = [
        'property_type' => 'json',
        'transaction_type' => 'json',
        'city' => 'json',
        'country' => 'json',
        'state' => 'json',
        'currency' => 'json',
        'amenities' => 'array',
        'payment' => 'array',
        'disposition' => 'array',
        'tags' => 'array',
        'images' => 'array',
        'google_map_data' => 'json',
    ];

}
