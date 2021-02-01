<?php

use App\Models\Auth\EmployerAttributes;
use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'cellphone' => '+989121000000',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        User::create([
            'first_name' => 'Default',
            'last_name' => 'User',
            'email' => 'user@user.com',
            'cellphone' => '+989122000000',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
        ]);

        $this->createTasker('Tasker', 'tasker@user.com', '+989123000000', false);
        $this->createTasker('Tasker Verified', 'verified_tasker@user.com', '+989123000001', true);
        $this->createTasker('Tasker Verified Two', 'verified_tasker2@user.com', '+989123000002', true);
        $this->createTasker('Tasker Verified Three', 'verified_tasker3@user.com', '+989123000003', true);


        User::create([
            'first_name' => 'Employer',
            'last_name' => 'User',
            'email' => 'employer@user.com',
            'cellphone' => '+989124000000',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
            'user_type' => 'employer',
            'attributes_id' => EmployerAttributes::create([
                'bio' => 'My Bio',
            ])->id,
        ]);

        User::create([
            'first_name' => 'Employer Two',
            'last_name' => 'User',
            'email' => 'employer2@user.com',
            'cellphone' => '+989124000002',
            'password' => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
            'user_type' => 'employer',
            'phone_verified_at' => \Carbon\Carbon::now(),
            'attributes_id' => EmployerAttributes::create([
                'bio' => 'My Bio',
            ])->id,
        ]);

        $this->enableForeignKeys();
    }

    private function createTasker($firstName, $email, $cellphone, $verified = false)
    {
        User::create([
            'first_name' => $firstName,
            'last_name' => 'Last Name',
            'email' => $email,
            'cellphone' => $cellphone,
            'password' => 'secret',
            'latitude' => 10,
            'longitude' => 10,
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed' => true,
            'user_type' => 'tasker',
            'phone_verified_at' => $verified ? \Carbon\Carbon::now() : null,
            'attributes_id' => TaskerAttributes::create([
                'address' => 'Address',
                'national_number' => '1234567890',
                'gender' => 'male',
                'birth_date' => new \DateTime('1987-11-04'),
                'bio' => 'My Bio',
                'hour_rate' => 10,
            ])->id,
        ]);
    }
}
