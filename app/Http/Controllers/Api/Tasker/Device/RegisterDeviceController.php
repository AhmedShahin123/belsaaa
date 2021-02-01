<?php

namespace App\Http\Controllers\Api\Tasker\Device;

use App\Factories\Auth\DeviceFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\Device\RegisterDeviceRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;

class RegisterDeviceController extends Controller
{
    public function __invoke(RegisterDeviceRequest $request, DeviceFactory $deviceFactory)
    {
        return $deviceFactory->create($request->validated(), $this->user(), $this->accessToken());
    }
}
