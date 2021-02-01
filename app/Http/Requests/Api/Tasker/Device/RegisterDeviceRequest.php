<?php
/**
 * User: amir
 * Date: 5/20/20
 * Time: 10:39 PM
 */

namespace App\Http\Requests\Api\Tasker\Device;


class RegisterDeviceRequest extends \App\Http\Requests\Api\Common\Device\RegisterDeviceRequest
{
    protected function getOwnerType(): string
    {
        return 'tasker';
    }
}
