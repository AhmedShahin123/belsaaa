<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @return \App\Models\Auth\User
     */
    public function user()
    {
        return \Auth::guard('api')->user();
    }

    public function accessToken()
    {
        $authHeader = request()->headers->get('Authorization');

        $exploded = explode('Bearer ', $authHeader);

        if (count($exploded) > 1) {
            return $exploded[1];
        }

        return null;
    }
}
