<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'address'  => $faker->address,
        'food_id'  => factory(App\Food::class)->create()->id,
    ];
});
