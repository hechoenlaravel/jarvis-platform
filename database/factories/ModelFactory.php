<?php

$factory->define(\Modules\Users\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('11235813**'),
        'remember_token' => str_random(10),
    ];
});
