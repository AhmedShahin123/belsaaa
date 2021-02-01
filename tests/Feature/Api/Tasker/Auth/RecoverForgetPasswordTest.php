<?php

namespace Tests\Feature\Api\Tasker\Auth;

use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecoverForgetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testForgetPasswordVerify()
    {
        $this->seed(\UserTableSeeder::class);
        $this->seed(\ClientSeed::class);
        $user = resolve(UserRepository::class)->findByCellphone('+989123000000');
        $jwt = $user->generateRecoverForgetPasswordToken()->resource->accessToken;
        $response = $this->postJson('https://api.belsaa.com/tasker/password/recover', ['password' => 'newpassword'], [
            'Authorization' => 'Bearer '.$jwt,
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['id']);
        $user->refresh();
        $this->assertTrue(\Hash::check('newpassword', $user->password));
    }
}
