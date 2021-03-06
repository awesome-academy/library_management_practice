<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rate;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'rate' => rand(0,5),
        'id_user' => rand(1,30),
        'id_book' => rand(1,50),
    ];
});
