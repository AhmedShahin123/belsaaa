<?php

namespace Tests\Feature\Api\Employer\Employer;

use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateEmployerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdateSuccessfully()
    {
        $this->seed(\UserTableSeeder::class);

        $employer = User::query()->where('email', 'employer@user.com')->first();
        Passport::actingAs(
            $employer,
            ['employer']
        );

        $response = $this->post('https://api.belsaa.com/employer/employer', [
            'company_name' => 'Test Company Edited',
            'location' => [
                'latitude' => 11.2,
                'longitude' => 11.3,
            ],
            'attributes' => [
                'bio' => 'Bio Edited',
                'office_photo' => UploadedFile::fake()->image('office_photo_edited.jpg'),
                'legal_document' => UploadedFile::fake()->image('legal_document_edited.jpg'),
            ],
        ], ['Accept' => 'application/json']);

        $response->assertOk();
        $body = json_decode($response->content(), true);
        $this->assertNotNull($body['user_attributes']['legal_document_url']);
        $this->assertNotNull($body['user_attributes']['office_photo_url']);
        $this->assertDatabaseHas('users', [
            'id' => $employer->id,
            'company_name' => 'Test Company Edited',
            'latitude' => 11.2,
            'longitude' => 11.3,
        ]);

        $this->assertDatabaseHas('employer_attributes', [
            'id' => $employer->attributes_id,
            'bio' => 'Bio Edited',
        ]);

        $this->assertDatabaseHas('media', [
            'model_type' => 'employer',
            'model_id' => $employer->user_attributes->id,
            'collection_name' => 'office_photo',
            'file_name' => 'office_photo_edited.jpg',
        ]);

        $this->assertDatabaseHas('media', [
            'model_type' => 'employer',
            'model_id' => $employer->user_attributes->id,
            'collection_name' => 'legal_document',
            'file_name' => 'legal_document_edited.jpg',
        ]);
    }

    public function testUpdateSuccessfullyWhenAllFieldsNotSent()
    {
        $this->seed(\UserTableSeeder::class);

        $employer = User::query()->where('email', 'employer@user.com')->first();
        Passport::actingAs(
            $employer,
            ['employer']
        );

        $response = $this->post('https://api.belsaa.com/employer/employer', [], ['Accept' => 'application/json']);

        $response->assertOk();
    }
}
