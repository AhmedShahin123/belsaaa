<?php
/**
 * User: amir
 * Date: 3/9/20
 * Time: 6:16 PM
 */

namespace App\Http\Controllers\Api\Tasker\Tasker;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\UserResource;

class ShowTaskerController extends Controller
{
    public function __invoke()
    {
        return UserResource::make($this->user()->load('user_attributes', 'user_attributes.working_days'));
    }
}
