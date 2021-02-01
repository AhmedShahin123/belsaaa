<?php

namespace Tests\Feature\Api\Tasker\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessfulLogin()
    {
        $this->seed(\AuthTableSeeder::class);

        $response = $this->postJson('https://api.belsaa.com/tasker/login', [
            'username' => '+989123000000',
            'password' => 'secret',
        ]);

        $response->assertOk();
    }

    public function testUnsuccessfulLogin()
    {
        $this->seed(\AuthTableSeeder::class);

        $response = $this->postJson('https://api.belsaa.com/tasker/login', [
            'username' => '+989123000000',
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('username');

        $response = $this->postJson('https://api.belsaa.com/tasker/login', [
            'username' => '+989123000002',
            'password' => 'secret',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('username');
    }
}
