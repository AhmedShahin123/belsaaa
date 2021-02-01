<?php
/**
 * User: amir
 * Date: 5/20/20
 * Time: 9:58 PM
 */

namespace App\Repositories\Auth;

use App\Device;
use App\Repositories\BaseRepository;
use Laravel\Passport\Client;

class DeviceRepository extends BaseRepository
{
    public function __construct(Device $model)
    {
        $this->model = $model;
    }
}
