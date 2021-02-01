<?php
/**
 * User: amir
 * Date: 5/20/20
 * Time: 9:59 PM
 */

namespace App\Factories\Auth;

use App\Device;
use App\Models\Auth\User;

class DeviceFactory
{
    public function create($attributes, ?User $user, ?string $accessToken = null): Device
    {
        $deviceId = $attributes['device_id'];
        $ownerType = $attributes['owner_type'];

        unset($attributes['device_id']);
        unset($attributes['owner_type']);

        $attributes['owner_id'] = $user ? $user->id : null;

        return Device::updateOrCreate([
            'device_id' => $deviceId,
            'owner_type' => $ownerType,
//            'access_token' => $accessToken, // TODO: Fix access_token too long problem
        ], $attributes);
    }

}
