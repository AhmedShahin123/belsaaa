<?php

namespace App\Http\Controllers\Api\Employer\Employer;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ShowEmployerController extends Controller
{
    public function __invoke()
    {
        return UserResource::make($this->user()->load('user_attributes'));
    }
}
