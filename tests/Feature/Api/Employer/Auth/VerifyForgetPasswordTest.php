<?php

namespace Tests\Feature\Api\Employer\Auth;

use App\Listeners\Auth\ForgetPasswordAccessTokenListener;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyForgetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testForgetPasswordVerify()
    {
        $this->seed(\UserTableSeeder::class);
        $this->seed(\ClientSeed::class);

        $user = resolve(UserRepository::class)->findByCellphone('+989124000000');
        $jwt = $user->requestForgetPassword()->resource->accessToken;

        $response = $this->postJson('https://api.belsaa.com/employer/password/verify', ['code' => '4321'], [
            'Authorization' => 'Bearer '.$jwt,
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['access_token']]);
    }
}
