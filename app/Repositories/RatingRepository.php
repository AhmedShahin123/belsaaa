<?php
/**
 * User: amir
 * Date: 8/6/20
 * Time: 6:03 PM
 */

namespace App\Repositories;


use App\Models\AssignmentRequestTasker;
use App\Models\Auth\User;
use App\Models\Rating;
use App\Models\Task;
use Illuminate\Database\Query\JoinClause;

class RatingRepository extends BaseRepository
{
    public function __construct(Rating $model)
    {
        $this->model = $model;
    }

    public function paginateByTasker(User $tasker)
    {
        $query = $this->model->newQuery();
        $query->select('ratings.*');

        $query->join('assignment_request_taskers', function (JoinClause $clause) {
            $clause
                ->where('ratings.rateable_type', AssignmentRequestTasker::class)
                ->on('ratings.rateable_id', 'assignment_request_taskers.id')
            ;
        });
        $query->where('assignment_request_taskers.tasker_id', $tasker->id);

        return $query->with('user', 'user.user_attributes')->paginate();
    }

    public function paginateByEmployer(User $employer)
    {
        $query = $this->model->newQuery();

        $query->select('ratings.*');
        $query->join('tasks', function (JoinClause $clause) {
            $clause
                ->where('ratings.rateable_type', Task::class)
                ->on('ratings.rateable_id', 'tasks.id')
            ;
        });
        $query->where('tasks.employer_id', $employer->id);

        return $query->with('user', 'user.user_attributes')->paginate();
    }
}
