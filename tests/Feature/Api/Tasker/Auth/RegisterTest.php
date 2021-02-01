<?php

namespace Tests\Feature\Api\Tasker\Auth;

use App\Models\Auth\User;
use App\Notifications\Frontend\Auth\VerifyCellphone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $response->assertOk();
        $response->assertJsonStructure(['data' => ['access_token', 'phone_verification_expires_at']]);
        $this->assertDatabaseHas('users', [
            'first_name' => 'Amir',
            'last_name' => 'Modarresi',
            'cellphone' => '+989125995014',
            'email' => 'amir@modarre.si',
            'latitude' => 10.2,
            'longitude' => 10.3,
        ]);

        $user = User::query()->where('email', 'amir@modarre.si')->first();
        $this->assertTrue(\Hash::check('test1234', $user->password));

        $this->assertDatabaseHas('tasker_attributes', [
            'id' => $user->attributes_id,
            'national_number' => '0123412345',
            'gender' => 'male',
            'birth_date' => '1987-11-04 00:00:00',
        ]);
        \Notification::assertSentTo($user, VerifyCellphone::class);

        /**
         * Register Without Optional Fields
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'first_name' => 'Amir 2',
            'last_name' => 'Modarresi 2',
            'cellphone' => '+989125995015',
            'email' => 'amir2@modarre.si',
            'password' => 'test1234',
            'latitude' => 10.2,
            'longitude' => 10.3,
            'attributes' => [
                'national_number' => '0123412345',
                'gender' => 'male',
                'birth_date' => '1987-11-04',
                'bio' => 'my bio',
                'hour_rate' => 10
            ],
        ]);
        $response->assertOk();
        $response->assertJsonStructure(['data' => ['access_token', 'phone_verification_expires_at']]);

        $user = User::query()->where('email', 'amir2@modarre.si')->first();
        $this->assertTrue(\Hash::check('test1234', $user->password));
        $this->assertDatabaseHas('tasker_attributes', [
            'id' => $user->attributes_id,
            'national_number' => '0123412345',
            'gender' => 'male',
            'birth_date' => '1987-11-04 00:00:00',
            'bio' => 'my bio',
            'hour_rate' => 10
        ]);
        \Notification::assertSentTo($user, VerifyCellphone::class);
    }

    public function testValidationOfCellphone()
    {
        $this->seed(\UserTableSeeder::class);
        /**
         * Cellphone format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '+989125995014',
        ]);
        $response->assertJsonMissingValidationErrors(['cellphone']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '09125995014',
        ]);
        $response->assertJsonMissingValidationErrors(['cellphone']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '9125995014',
        ]);
        $response->assertJsonMissingValidationErrors(['cellphone']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '+966512345678',
        ]);
        $response->assertJsonMissingValidationErrors(['cellphone']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '0512345678',
        ]);
        $response->assertJsonMissingValidationErrors(['cellphone']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '512345678',
        ]);
        $response->assertJsonMissingValidationErrors(['cellphone']);

        /**
         * Cellphone must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['cellphone']);

        /**
         * Cellphone format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '123213412',
        ]);
        $response->assertJsonValidationErrors(['cellphone']);

        /**
         * Cellphone must not be duplicated
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'cellphone' => '09122000000',
        ]);
        $response->assertJsonValidationErrors(['cellphone']);
    }

    public function testValidationOfFirstName()
    {
        /**
         * First name format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'first_name' => 'Amir',
        ]);
        $response->assertJsonMissingValidationErrors(['first_name']);

        /**
         * First name format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'first_name' => '',
        ]);
        $response->assertJsonValidationErrors(['first_name']);

        /**
         * First name must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['first_name']);
    }

    public function testValidationOfLastName()
    {
        /**
         * Last name format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'last_name' => 'Modarresi',
        ]);
        $response->assertJsonMissingValidationErrors(['last_name']);

        /**
         * Last name format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'last_name' => '',
        ]);
        $response->assertJsonValidationErrors(['last_name']);

        /**
         * Last name must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['last_name']);
    }

    public function testValidationOfEMail()
    {
        $this->seed(\UserTableSeeder::class);
        /**
         * Email format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'email' => 'amir@modarre.si',
        ]);
        $response->assertJsonMissingValidationErrors(['email']);

        /**
         * Email format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'email' => '',
        ]);
        $response->assertJsonValidationErrors(['email']);

        /**
         * Email format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'email' => 'wrong_email_format',
        ]);
        $response->assertJsonValidationErrors(['email']);

        /**
         * Email must not duplicated
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'email' => 'user@user.com',
        ]);
        $response->assertJsonValidationErrors(['email']);

        /**
         * Email must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['email']);
    }

    public function testValidationOfPassword()
    {
        /**
         * Password format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'password' => 'test1234',
        ]);
        $response->assertJsonMissingValidationErrors(['password']);

        /**
         * Password format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'password' => '',
        ]);
        $response->assertJsonValidationErrors(['password']);

        /**
         * Password format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'password' => '12345',
        ]);
        $response->assertJsonValidationErrors(['password']);

        /**
         * Password must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['password']);
    }

    public function testValidationOfLatitude()
    {
        /**
         * Latitude format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'latitude' => 10.2,
        ]);
        $response->assertJsonMissingValidationErrors(['latitude']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'latitude' => '10.2',
        ]);
        $response->assertJsonMissingValidationErrors(['latitude']);

        /**
         * Latitude format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'latitude' => '',
        ]);
        $response->assertJsonValidationErrors(['latitude']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'latitude' => 'sadasd',
        ]);
        $response->assertJsonValidationErrors(['latitude']);

        /**
         * Latitude must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['latitude']);
    }

    public function testValidationOfLongitude()
    {
        /**
         * Longitude format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'longitude' => 10.2,
        ]);
        $response->assertJsonMissingValidationErrors(['longitude']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'longitude' => '10.2',
        ]);
        $response->assertJsonMissingValidationErrors(['longitude']);

        /**
         * Longitude format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'longitude' => '',
        ]);
        $response->assertJsonValidationErrors(['longitude']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'longitude' => 'sadasd',
        ]);
        $response->assertJsonValidationErrors(['longitude']);

        /**
         * Longitude must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['longitude']);
    }

    public function testValidationOfNational()
    {
        /**
         * National number format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'national_number' => '1234567890',
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.national_number']);

        /**
         * National number format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'national_number' => '',
            ]
        ]);
        $response->assertJsonValidationErrors(['attributes.national_number']);

        /**
         * National number must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['attributes.national_number']);
    }

    public function testValidationOfGender()
    {
        /**
         * Gender format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'gender' => 'male',
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.gender']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'gender' => 'female',
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.gender']);

        /**
         * Gender format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'gender' => '',
            ]
        ]);
        $response->assertJsonValidationErrors(['attributes.gender']);

        /**
         * Gender must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['attributes.gender']);
    }

    public function testValidationOfBirth()
    {
        /**
         * Birth date format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'birth_date' => '1987-11-04',
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.birth_date']);

        /**
         * Birth date format is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'birth_date' => 'wrong birth date',
            ]
        ]);
        $response->assertJsonValidationErrors(['attributes.birth_date']);

        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'birth_date' => '',
            ]
        ]);
        $response->assertJsonValidationErrors(['attributes.birth_date']);

        /**
         * Birth date must be exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonValidationErrors(['attributes.birth_date']);
    }

    public function testValidationOfBio()
    {
        /**
         * Bio format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'bio' => 'my bio',
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.bio']);

        /**
         * Bio can be empty
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'bio' => '',
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.bio']);

        /**
         * Bio can be not exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonMissingValidationErrors(['attributes.bio']);
    }

    public function testValidationOfHour()
    {
        /**
         * Hour rate format is valid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'hour_rate' => 20,
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.hour_rate']);

        /**
         * Hour rate is invalid
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'hour_rate' => 'wrong hour rate',
            ]
        ]);
        $response->assertJsonValidationErrors('attributes.hour_rate');

        /**
         * Hour rate can be empty
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', [
            'attributes' => [
                'hour_rate' => '',
            ]
        ]);
        $response->assertJsonMissingValidationErrors(['attributes.hour_rate']);

        /**
         * Hour rate can be not exists
         */
        $response = $this->postJson('https://api.belsaa.com/tasker/register', []);
        $response->assertJsonMissingValidationErrors(['attributes.hour_rate']);
    }
}
