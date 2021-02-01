<?php

namespace Tests\Feature\Api\Employer\BankAccount;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateBankAccountTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->seed(\UserTableSeeder::class);
        $response = $this->postJson('https://api.belsaa.com/employer/bank_account', [
            'type' => 'visa',
            'holder_name' => 'Amir Modarresi',
            'card_number' => 'Card Number',
            'expiration_date' => '',
            'cvc_number' => '',
        ]);

        $response->assertStatus(200);
    }
}
