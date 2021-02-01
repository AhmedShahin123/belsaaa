<?php

namespace Tests\Feature\Api\Tasker\BankAccount;

use App\Models\Auth\User;
use App\Models\TaskerBankAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class IndexBankAccountTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetListOfBankAccountsForTasker()
    {
        $this->seed(\DatabaseSeeder::class);

        $tasker = User::query()->where('email', 'verified_tasker@user.com')->first();
        factory(TaskerBankAccount::class)->create(['tasker_attributes_id' => $tasker->user_attributes->id]);
        factory(TaskerBankAccount::class)->create(['tasker_attributes_id' => $tasker->user_attributes->id]);

        $tasker2 = User::query()->where('email', 'tasker@user.com')->first();
        factory(TaskerBankAccount::class)->create(['tasker_attributes_id' => $tasker2->user_attributes->id]);

        Passport::actingAs($tasker, ['tasker']);

        $response = $this->get('https://api.belsaa.com/tasker/bank_account');

        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
    }
}
