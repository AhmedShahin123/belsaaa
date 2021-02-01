<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'device_id',
        'fcm_token',
        'owner_type',
        'owner_id',
        'access_token',
        'language',
    ];
}
