<?php

namespace Tests\Feature\Api\Employer\Auth;

use App\Repositories\Auth\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class VerifyPhoneTest extends TestCase
{
    use RefreshDatabase;

    public function testVerifyCellPhoneAfterRegister()
    {
        $this->seed(\AuthTableSeeder::class);

        $response = $this->post('https://api.belsaa.com/employer/register', [
            'company_name' => 'My Company',
            'cellphone' => '+989125995014',
            'email' => 'amir@modarre.si',
            'password' => 'test1234',
            'latitude' => 10.2,
            'longitude' => 10.3,
            'attributes' => [
                'bio' => 'My Bio',
                'office_photo' => UploadedFile::fake()->image('test.jpg'),
            ],
        ], ['Accept' => 'application/json']);

        $user = resolve(UserRepository::class)->findByCellphone('+989125995014');
        $this->assertNull($user->phone_verified_at);
        $jwt = json_decode($response->getContent(), true)['data']['access_token'];

        $response = $this->putJson('https://api.belsaa.com/employer/phone/verify', ['code' => '1234', 'cellphone' => '+989125995014'], [
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
        $response = $this->post('https://api.belsaa.com/employer/register', [
            'company_name' => 'My Company',
            'cellphone' => '+989125995014',
            'email' => 'amir@modarre.si',
            'password' => 'test1234',
            'latitude' => 10.2,
            'longitude' => 10.3,
            'attributes' => [
                'bio' => 'My Bio',
                'office_photo' => UploadedFile::fake()->image('test.jpg'),
            ],
        ], ['Accept' => 'application/json']);

        $user = resolve(UserRepository::class)->findByCellphone('+989125995014');
        $this->assertNull($user->phone_verified_at);
        $jwt = json_decode($response->getContent(), true)['data']['access_token'];
        $user->forceFill([
            'phone_verification_expires_at' => Carbon::now()->subHour(),
        ])->save();

        $response = $this->putJson('https://api.belsaa.com/employer/phone/verify', ['code' => '1234', 'cellphone' => '+989125995014'], [
            'Authorization' => 'Bearer '.$jwt,
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('code');

        $response = $this->putJson('https://api.belsaa.com/employer/phone/resend', [], [
            'Authorization' => 'Bearer '.$jwt,
        ]);

        $response = $this->putJson('https://api.belsaa.com/employer/phone/verify', ['code' => '1234', 'cellphone' => '+989125995014'], [
            'Authorization' => 'Bearer '.$jwt,
        ]);

        $response->assertNoContent();
        $user->refresh();
        $this->assertNotNull($user->phone_verified_at);
    }
}
