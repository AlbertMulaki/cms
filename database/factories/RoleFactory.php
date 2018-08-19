<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    $roles = config('cms.roles');
    $role = $faker->randomElement($roles);
    return [
        'name' => $role,
        'guard_name' => 'web',
    ];
});
