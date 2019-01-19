<?php

use Faker\Generator as Faker;
use App\Attachment;

$factory->define(Attachment::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'name' => $faker->word(1).'.file',
        'complain_id' => random_int(1, 50),
    ];
});
