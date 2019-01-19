<?php

use Faker\Generator as Faker;
use App\ComplainType;

$factory->define(ComplainType::class, function (Faker $faker) {
    return [
        'title' => $faker->word(1),
    ];
});
