<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Proverb;
use Faker\Generator as Faker;

$factory->define(Proverb::class, function (Faker $faker) {
    return [
        'message'=>$faker->paragraph(4)
    ];
});
