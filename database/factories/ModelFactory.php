<?php
use App\User;
use App\Building;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tenant::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'floor' => $faker->numberBetween(1, 100),
        'unit' => $faker->numberBetween(100, 1000),
        'building_id' => function() {
            return factory(App\Building::class)->create()->id;
        },
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail
    ];

});

$factory->define(App\Building::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'floors' => $faker->numberBetween(1, 100),
        'has_image' => $faker->boolean,
        'address1' => $faker->address,
        'address2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'postal_code' => $faker->postcode,
        'owner_id' => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});
