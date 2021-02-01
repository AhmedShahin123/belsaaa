<?php

namespace Tests\Feature\Api\Tasker\BankAccount;

use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateBankAccountTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateBankAccount()
    {
        $this->seed(\UserTableSeeder::class);

        $tasker = User::query()->where('email', 'verified_tasker@user.com')->first();
        Passport::actingAs(
            $tasker,
            ['tasker']
        );

        $response = $this->postJson('https://api.belsaa.com/tasker/bank_account', [
            'iban' => '123456909876543',
            'bank_name' => 'Best Bank',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('tasker_bank_accounts', [
            'tasker_attributes_id' => $tasker->user_attributes->id,
            'iban' => '123456909876543',
            'bank_name' => 'Best Bank',
        ]);

    }
}
