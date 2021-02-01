<?php

namespace Tests\Feature\Api\Tasker\Auth;

use App\Repositories\Auth\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyPhoneTest extends TestCase
{
    use RefreshDatabase;

    public function testVerifyCellPhoneAfterRegister()
    {
        $this->seed(\AuthTableSeeder::class);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'first_name' => 'Amir',
            'last_name' => 'Modarresi',
            'cellphone' => '+989125995014',
            'email' => 'amir@modarre.si',
            'password' => 'test1234',
            'latitude' => 10.2,
            'longitude' => 10.3,
            'attributes' => [
                'national_number' => '0123412345',
                'gender' => 'male',
                'birth_date' => '1987-11-04',
            ],
        ]);

        $user = resolve(UserRepository::class)->findByCellphone('+989125995014');
        $this->assertNull($user->phone_verified_at);
        $jwt = json_decode($response->getContent(), true)['data']['access_token'];

        $response = $this->putJson('https://api.belsaa.com/tasker/phone/verify', ['code' => '1234', 'cellphone' => '+989125995014'], [
            'Authorization' => 'Bearer '.$jwt,
        ]);
        $response->assertNoContent();
        $user->refresh();
        $this->assertNotNull($user->phone_verified_at);
    }

    public function testVerifyCellPhoneAfterRegisterWithResend()
    {
        $this->seed(\AuthTableSeeder::class);

        /**
         * Register Without Optional Fields
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'first_name' => 'Amir',
            'last_name' => 'Modarresi',
            'cellphone' => '+989125995014',
            'email' => 'amir@modarre.si',
            'password' => 'test1234',
            'latitude' => 10.2,
            'longitude' => 10.3,
            'attributes' => [
                'national_number' => '0123412345',
                'gender' => 'male',
                'birth_date' => '1987-11-04',
            ],
        ]);

        $user = resolve(UserRepository::class)->findByCellphone('+989125995014');
        $this->assertNull($user->phone_verified_at);
        $jwt = json_decode($response->getContent(), true)['data']['access_token'];
        $user->forceFill([
            'phone_verification_expires_at' => Carbon::now()->subHour(),
        ])->save();

        $response = $this->putJson('https://api.belsaa.com/tasker/phone/verify', ['code' => '1234', 'cellphone' => '+989125995014'], [
            'Authorization' => 'Bearer '.$jwt,
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('code');

        $response = $this->putJson('https://api.belsaa.com/tasker/phone/resend', [], [
            'Authorization' => 'Bearer '.$jwt,
        ]);

        $response = $this->putJson('https://api.belsaa.com/tasker/phone/verify', ['code' => '1234', 'cellphone' => '+989125995014'], [
            'Authorization' => 'Bearer '.$jwt,
        ]);

        $response->assertNoContent();
        $user->refresh();
        $this->assertNotNull($user->phone_verified_at);
    }
}
