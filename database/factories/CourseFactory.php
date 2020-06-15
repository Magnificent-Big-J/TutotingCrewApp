<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->paragraph,
        'description' => $faker->sentence(2)
    ];
});
