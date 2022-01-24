<?php

use Faker\Generator as Faker;

$factory->define(App\Food::class, function (Faker $faker) {
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
    return [
        'name' => $faker->foodName(),
        'amount' => $faker->randomNumber(2),
        'admin_id' => App\User::where('is_admin', 1)->first(),
    ];
});
