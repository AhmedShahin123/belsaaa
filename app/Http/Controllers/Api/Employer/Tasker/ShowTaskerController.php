<?php
/**
 * User: amir
 * Date: 8/6/20
 * Time: 7:10 PM
 */

namespace App\Http\Controllers\Api\Employer\Tasker;


use App\Models\Auth\User;
use Illuminate\Http\Response;

class ShowTaskerController
{
    public function __invoke(User $tasker)
    {
        if ($tasker->user_type !== 'tasker') {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $tasker->load('user_attributes');
    }
}
