<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\PropiedadModel
 *
 * @property int $id
 * @property string|null $title
 * @property mixed|null $property_type
 * @property mixed|null $transaction_type
 * @property mixed|null $currency
 * @property string|null $address
 * @property int|null $address_number
 * @property mixed|null $google_map_data
 * @property mixed|null $city
 * @property mixed|null $state
 * @property mixed|null $country
 * @property string|null $neighborhood
 * @property int|null $rooms
 * @property int|null $bedrooms
 * @property int|null $bathrooms
 * @property int|null $garages
 * @property int|null $m2
 * @property int|null $m2_covered
 * @property int|null $year
 * @property int|null $price
 * @property mixed|null $amenities
 * @property mixed|null $images
 * @property string $status
 * @property mixed|null $payment
 * @property mixed|null $disposition
 * @property mixed|null $tags
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereAddressNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereDisposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereGarages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereGoogleMapData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereM2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereM2Covered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereNeighborhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel wherePropertyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropiedadModel whereYear($value)
 * @mixin \Eloquent
 */
	class IdeHelperPropiedadModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser extends \Eloquent {}
}

