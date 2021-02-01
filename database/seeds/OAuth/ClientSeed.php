<?php

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class ClientSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(ClientRepository::class)->createPersonalAccessClient(null, 'api', 'http://localhost');
    }
}
