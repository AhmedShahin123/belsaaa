<?php

namespace Tests\Feature\Api\Employer\Auth;

use App\Notifications\Frontend\Auth\VerifyCellphone;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForgetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testForgetPasswordRequest()
    {
        $this->seed(\UserTableSeeder::class);
        $this->seed(\ClientSeed::class);
        \Notification::fake();

        $response = $this->postJson('https://api.belsaa.com/employer/password/forget', ['cellphone' => '+989124000000']);
        $response->assertOk();
        $response->assertJsonStructure(['data' => ['access_token']]);
        $user = resolve(UserRepository::class)->findByCellphone('+989124000000');

        \Notification::assertSentTo($user, VerifyCellphone::class);
    }
}
