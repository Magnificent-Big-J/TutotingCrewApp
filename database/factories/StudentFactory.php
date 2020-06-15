<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
        'email' => $this->faker->email,
        'phone' => $this->faker->phoneNumber,
        'location' => $this->faker->address
    ];
});
