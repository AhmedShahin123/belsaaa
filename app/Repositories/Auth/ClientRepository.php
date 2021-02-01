<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories\Auth;

use App\Repositories\BaseRepository;
use Laravel\Passport\Client;

class ClientRepository extends BaseRepository
{
    public function __construct(Client $model)
    {
        $this->model = $model;
    }
}
