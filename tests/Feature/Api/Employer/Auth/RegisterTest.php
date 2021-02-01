<?php

namespace Tests\Feature\Api\Employer\Auth;

use App\Models\Auth\User;
use App\Notifications\Frontend\Auth\VerifyCellphone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanRegister()
    {
        $this->seed(\AuthTableSeeder::class);
        \Notification::fake();

        /**
         * Register Without Optional Fields
         */
        $response = $this->post('https://api.belsaa.com/employer/register', [
            'company_name' => 'Test Company',
            'cellphone' => '+989125995015',
            'email' => 'amir2@modarre.si',
            'password' => 'test1234',
            'latitude' => 10.2,
            'longitude' => 10.3,
            'attributes' => [
                'bio' => 'Bio',
                'office_photo' => UploadedFile::fake()->image('test.jpg'),
                'legal_document' => UploadedFile::fake()->image('test.jpg'),
            ],
        ], ['Accept' => 'application/json']);
        $response->assertOk();
        $response->assertJsonStructure(['data' => ['access_token', 'user']]);
        $this->assertDatabaseHas('users', [
            'first_name' => null,
            'last_name' => null,
            'company_name' => 'Test Company',
            'cellphone' => '+989125995015',
            'email' => 'amir2@modarre.si',
            'latitude' => 10.2,
            'longitude' => 10.3,
        ]);

        $user = User::query()->where('email', 'amir2@modarre.si')->first();
        $this->assertTrue(\Hash::check('test1234', $user->password));

        $this->assertDatabaseHas('employer_attributes', [
            'id' => $user->attributes_id,
            'national_number' => null,
            'gender' => null,
            'birth_date' => null,
            'bio' => 'Bio',
        ]);

        $this->assertDatabaseHas('media', [
            'model_type' => 'employer',
            'model_id' => $user->user_attributes->id,
            'collection_name' => 'office_photo'
        ]);

        $this->assertDatabaseHas('media', [
            'model_type' => 'employer',
            'model_id' => $user->user_attributes->id,
            'collection_name' => 'legal_document'
        ]);

        \Notification::assertSentTo($user, VerifyCellphone::class);

        /**
         * Register Without Optional Fields
         */
        $response = $this->postJson('https://api.belsaa.com/employer/register', [
            'company_name' => 'Test Company',
            'cellphone' => '+989125995014',
            'email' => 'amir@modarre.si',
            'password' => 'test1234',
            'latitude' => 10.2,
            'longitude' => 10.3,
            'attributes' => [
                'bio' => 'Bio',
                'office_photo_base64' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAABHNCSVQICAgIfAhkiAAAABl0RVh0U29mdHdhcmUAZ25vbWUtc2NyZWVuc2hvdO8Dvz4AAAAvdEVYdENyZWF0aW9uIFRpbWUAVHVlIDA3IEFwciAyMDIwIDEyOjU1OjU1IFBNICswNDMw5ZYQggAAAA1JREFUCJljeHLnyn8ACNADlJQBsfQAAAAASUVORK5CYII=',
                'legal_document_base64' => 'data:@file/pdf;base64,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',
            ],
        ], ['Accept' => 'application/json']);
        $response->assertOk();
        $response->assertJsonStructure(['data' => ['access_token', 'user']]);
        $this->assertDatabaseHas('users', [
            'first_name' => null,
            'last_name' => null,
            'company_name' => 'Test Company',
            'cellphone' => '+989125995014',
            'email' => 'amir@modarre.si',
            'latitude' => 10.2,
            'longitude' => 10.3,
        ]);

        $user = User::query()->where('email', 'amir@modarre.si')->first();
        $this->assertTrue(\Hash::check('test1234', $user->password));

        $this->assertDatabaseHas('employer_attributes', [
            'id' => $user->attributes_id,
            'national_number' => null,
            'gender' => null,
            'birth_date' => null,
            'bio' => 'Bio',
        ]);

        $this->assertDatabaseHas('media', [
            'model_type' => 'employer',
            'model_id' => $user->user_attributes->id,
            'collection_name' => 'office_photo'
        ]);

        $this->assertDatabaseHas('media', [
            'model_type' => 'employer',
            'model_id' => $user->user_attributes->id,
            'collection_name' => 'legal_document'
        ]);

        \Notification::assertSentTo($user, VerifyCellphone::class);
    }
}
