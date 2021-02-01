<?php

namespace Tests\Feature\Api\Employer\Employer;

use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ShowEmployerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowSuccessfully()
    {
        $this->seed(\UserTableSeeder::class);

        $employer = User::query()->where('email', 'employer@user.com')->first();
        Passport::actingAs(
            $employer,
            ['employer']
        );

        $response = $this->get('https://api.belsaa.com/employer/employer');
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'company_name', 'user_attributes' => ['bio', 'legal_document_url', 'office_photo_url']]);
        $response->assertJsonFragment(['id' => $employer->id]);
    }
}
