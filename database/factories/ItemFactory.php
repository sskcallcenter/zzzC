<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'textbox' => $faker->name,
        'textarea' => $faker->realText(50),
        'radiobtn' => $faker->randomElement($array = array_keys(\Config::get('const.RADIOS'))),
        'select' => $faker->randomElement($array = array_keys(\Config::get('const.SELECTS'))),
        'checkbox' => implode(
            ',',
            $faker->randomElements(
                $array = array_keys(\Config::get('const.CHECKS')),
                $faker->numberBetween($min = 1, $max = 8)
            )
        ),
    ];
});
