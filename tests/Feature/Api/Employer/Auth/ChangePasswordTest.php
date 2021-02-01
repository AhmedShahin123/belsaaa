<?php

namespace Tests\Feature\Api\Employer\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;
    public function testChangePassword()
    {
        $this->seed(\AuthTableSeeder::class);

        $response = $this->postJson('https://api.belsaa.com/employer/login', [
            'username' => '+989124000000',
            'password' => 'secret',
        ]);

        $jwt = json_decode($response->getContent(), true)['data']['access_token'];

        $response = $this->putJson('https://api.belsaa.com/employer/password/change', [
            'old_password' => 'secret',
            'new_password' => 'new_password',
        ], [
            'Authorization' => 'Bearer '.$jwt
        ]);

        $response->assertNoContent();

        $response = $this->postJson('https://api.belsaa.com/employer/login', [
            'username' => '+989124000000',
            'password' => 'new_password',
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['access_token']]);
    }
}
