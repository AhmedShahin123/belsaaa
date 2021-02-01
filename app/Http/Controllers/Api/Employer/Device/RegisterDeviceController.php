<?php

namespace App\Http\Controllers\Api\Employer\Device;

use App\Factories\Auth\DeviceFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\Device\RegisterDeviceRequest;
use Illuminate\Http\Request;

class RegisterDeviceController extends Controller
{
    public function __invoke(RegisterDeviceRequest $request, DeviceFactory $deviceFactory)
    {
        return $deviceFactory->create($request->validated(), $this->user(), $this->accessToken());
    }
}
