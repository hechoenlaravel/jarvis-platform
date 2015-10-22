<?php

$factory->define(\Modules\Users\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'uuid' => Uuid::generate(4),
        'email' => $faker->email,
        'password' => '11235813**',
        'remember_token' => str_random(10),
    ];
});
