<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Community;
use App\User;
use App\Role;
use Faker\Generator as Faker;

$factory->define(Community::class, function (Faker $faker) {
    return [
        'cad_ref_com' => $faker->regexify('[A-Za-z0-9]{20}'),
        'address' => $faker->streetAddress,
        'apart_num' => $faker->shuffle([1, 2, 3, 4, 5, 6, 7, 8])
    ];
});
