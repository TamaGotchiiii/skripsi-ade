<?php

use Faker\Generator as Faker;
use App\Complain;

$factory->define(Complain::class, function (Faker $faker) {
    return [
        'complain_code' => $faker->randomNumber($nbDigits = 6),
        'name' => $faker->name,
        'id_number' => $faker->randomNumber($nbDigits = 8),
        'description' => $faker->sentence(10),
        'email' => $faker->safeEmail,
        'status' => random_int(0, 2),
        'complain_type_id' => random_int(1, 5),
        'user_id' => random_int(1, 5),
        'unit_id' => random_int(1, 5),
    ];
});
