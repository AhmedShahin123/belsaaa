<?php
/**
 * User: amir
 * Date: 8/6/20
 * Time: 6:10 PM
 */

namespace App\Http\Controllers\Api\Employer\Tasker;


use App\Http\Controllers\Api\Controller;
use App\Models\Auth\User;
use App\Repositories\RatingRepository;
use Illuminate\Http\Response;

class IndexRatingForTaskerController extends Controller
{
    public function __invoke(User $tasker, RatingRepository $repository)
    {
        if ($tasker->user_type !== 'tasker') {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $repository->paginateByTasker($tasker);
    }
}
