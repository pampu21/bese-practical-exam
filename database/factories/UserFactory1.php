<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'password' => $faker->password
        // 'password' => bcrypt('asdqwe123'),
    ];
});

