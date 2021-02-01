<?php

use App\Models\Auth\EmployerAttributes;
use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\User;
use Faker\Generator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Generator $faker) {
    return [
        'uuid' => Uuid::uuid4()->toString(),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'password_changed_at' => null,
        'remember_token' => Str::random(10),
        'confirmation_code' => md5(uniqid(mt_rand(), true)),
        'active' => true,
        'confirmed' => true,
        'cellphone' => '+98912'.$faker->randomNumber(7),
    ];
});

$factory->state(User::class, 'tasker', function ($args, $args2) {
    return [
        'user_type' => 'tasker',
        'latitude' => 10,
        'longitude' => 10,
        'attributes_id' => TaskerAttributes::create([
            'address' => 'Address',
            'national_number' => '1234567890',
            'gender' => 'male',
            'birth_date' => new \DateTime('1987-11-04'),
            'bio' => 'My Bio',
            'hour_rate' => 10,
        ])->id
    ];
});

$factory->state(User::class, 'employer', function ($args, $args2) {
    return [
        'user_type' => 'employer',
        'attributes_id' => EmployerAttributes::create([
            'bio' => 'My Bio',
        ])->id
    ];
});

$factory->state(User::class, 'active', function () {
    return [
        'active' => true,
    ];
});

$factory->state(User::class, 'inactive', function () {
    return [
        'active' => false,
    ];
});

$factory->state(User::class, 'confirmed', function () {
    return [
        'confirmed' => true,
    ];
});

$factory->state(User::class, 'unconfirmed', function () {
    return [
        'confirmed' => false,
    ];
});

$factory->state(User::class, 'softDeleted', function () {
    return [
        'deleted_at' => now(),
    ];
});

