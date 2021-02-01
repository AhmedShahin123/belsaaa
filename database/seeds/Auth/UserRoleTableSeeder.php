<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        User::query()->where('email', 'admin@admin.com')->first()->assignRole(config('access.users.admin_role'));
        User::query()->where('email', 'user@user.com')->first()->assignRole(config('access.users.default_role'));

        $this->enableForeignKeys();
    }
}
