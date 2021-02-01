<?php
/**
 * User: amir
 * Date: 8/6/20
 * Time: 6:10 PM
 */

namespace App\Http\Controllers\Api\Tasker\Employer;


use App\Http\Controllers\Api\Controller;
use App\Models\Auth\User;
use App\Repositories\RatingRepository;
use Illuminate\Http\Response;

class IndexRatingForEmployerController extends Controller
{
    public function __invoke(User $employer, RatingRepository $repository)
    {
        if ($employer->user_type !== 'employer') {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $repository->paginateByEmployer($employer);
    }
}
