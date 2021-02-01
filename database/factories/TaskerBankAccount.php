<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TaskerBankAccount;
use Faker\Generator as Faker;

$factory->define(TaskerBankAccount::class, function (Faker $faker) {
    return [
        'iban' => $faker->iban(),
        'bank_name' => $faker->company,
    ];
});
