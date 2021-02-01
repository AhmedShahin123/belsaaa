<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;


use App\Models\AssignmentRequestTasker;
use App\Models\Auth\User;
use App\Models\Interfaces\AssignmentRequestTaskerInterface;
use App\Models\Interfaces\TaskInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Webmozart\Assert\Assert;

class AssignmentRequestTaskerRepository extends BaseRepository
{
    public function __construct(AssignmentRequestTasker $model)
    {
        $this->model = $model;
    }

    public function taskerAccept(AssignmentRequestTasker $assignmentRequestTasker)
    {
        DB::transaction(function() use($assignmentRequestTasker) {
            $assignmentRequestTasker->tasker_accept();
        });
    }

    public function taskerReject(AssignmentRequestTasker $assignmentRequestTasker)
    {
        DB::transaction(function() use($assignmentRequestTasker) {
            $assignmentRequestTasker->tasker_reject();
        });
    }

    public function taskerTimeout(AssignmentRequestTasker $assignmentRequestTasker)
    {
        DB::transaction(function() use($assignmentRequestTasker) {
            $assignmentRequestTasker->tasker_timeout();
        });
    }

    public function employerAccept(AssignmentRequestTasker $assignmentRequestTasker)
    {
        DB::transaction(function() use($assignmentRequestTasker) {
            $assignmentRequestTasker->employer_accept();
        });
    }

    public function employerReject(AssignmentRequestTasker $assignmentRequestTasker)
    {
        DB::transaction(function() use($assignmentRequestTasker) {
            $assignmentRequestTasker->employer_reject();
        });
    }

    public function employerTimeout(AssignmentRequestTasker $assignmentRequestTasker)
    {
        DB::transaction(function() use($assignmentRequestTasker) {
            $assignmentRequestTasker->employer_timeout();
        });
    }

    public function close(AssignmentRequestTasker $assignmentRequestTasker)
    {
        DB::transaction(function() use($assignmentRequestTasker) {
            $assignmentRequestTasker->close();
        });
    }

    public function canRespondByTasker(AssignmentRequestTasker $assignmentRequestTasker)
    {
        return !Carbon::now()->subMinutes(7)->greaterThan($assignmentRequestTasker->status_updated_at);
    }

    public function canRespondByEmployer(AssignmentRequestTasker $assignmentRequestTasker)
    {
        return $assignmentRequestTasker->task->can_accept() && !Carbon::now()->subHours(4)->greaterThan($assignmentRequestTasker->status_updated_at);
    }

    public function paginateByTasker(User $user, array $params = [])
    {
        Assert::eq($user->user_type, 'tasker');

        $query = $this->model->newQuery();
        $query->select('assignment_request_taskers.*');
        $query->where('tasker_id', $user->id);

        if (isset($params['status'])) {
            $query->where('assignment_request_taskers.status', $params['status']);

            if (count(array_intersect([AssignmentRequestTaskerInterface::STATUS_PENDING], (array) $params['status'])) > 0) {
                $query
                    ->join('tasks', 'tasks.id', '=', 'assignment_request_taskers.task_id')
                    ->where('tasks.status', TaskInterface::STATUS_SENDING);
            }
        }

        $query->whereHas('task', function (Builder $q) {
//            $q->whereHas('employer_accepted_requests', null, '<', 'tasks.required_tasker_number');
            $q->startAtNotPassed();
            $q->status('sending');
        });

        return $query->select('assignment_request_taskers.*')->with(['tasker', 'task', 'task.task_attributes'])->paginate();
    }

    public function paginateByEmployer(User $user, array $params = [])
    {
        Assert::eq($user->user_type, 'employer');

        /** @var Builder $query */
        $query = $user->employer_assignment_request_taskers()->getQuery();
        $query->select('assignment_request_taskers.*');
        if (isset($params['status'])) {
            $query->where('assignment_request_taskers.status', $params['status']);
        }

        $query->whereHas('task', function (Builder $q) {
//            $q->whereHas('employer_accepted_requests', null, '<', 'tasks.required_tasker_number');
            $q->startAtNotPassed();
            $q->status('sending');
        });

        return $query->select('assignment_request_taskers.*')->with(['tasker', 'tasker.user_attributes', 'task', 'task.task_attributes'])->paginate();
    }

    /**
     * @param User $user
     * @param int $id
     * @return AssignmentRequestTasker|null|mixed
     */
    public function getByIdAndTasker(User $user, int $id): ?AssignmentRequestTasker
    {
        Assert::eq($user->user_type, 'tasker');

        $query = $this->newQuery();

        return $query
            ->where('tasker_id', $user->id)
            ->where('id', $id)
            ->with(['tasker', 'task', 'task.task_attributes'])
            ->first()
        ;
    }



    /**
     * @return Builder
     */
    public function byUnansweredByTaskerQuery(): Builder
    {
        $query = $this->model->newQuery();
        $query
            ->status(AssignmentRequestTaskerInterface::STATUS_PENDING)
            ->join('tasks', 'tasks.id', '=', 'assignment_request_taskers.task_id')
            ->whereIn('tasks.status', [
                TaskInterface::STATUS_SENDING,
            ])
            ->where('status_updated_at', '<=', Carbon::now()->subMinutes(7))
            ->select('assignment_request_taskers.*')
        ;

        return $query;
    }

    public function overlappingOneTimeRequest(AssignmentRequestTasker $assignmentRequestTasker)
    {
        $query = $this->model->newQuery();

        $query->whereHas('task', function (Builder $q) use ($assignmentRequestTasker) {
            $q->where('task_type', 'one_time');
            $q->where('tasks.start_at', '<', $assignmentRequestTasker->task->end_at);
            $q->where('tasks.end_at', '>', $assignmentRequestTasker->task->start_at);
            $q->whereIn('tasks.status', [
                TaskInterface::STATUS_SENDING,
                TaskInterface::STATUS_ACCEPTED,
                TaskInterface::STATUS_SELECTED_BY_TASKER,
                TaskInterface::STATUS_INITIATE,
                TaskInterface::STATUS_STARTED
            ]);
        });

        $query->where('assignment_request_taskers.id', '<>', $assignmentRequestTasker->id);
        $query->where('assignment_request_taskers.tasker_id', $assignmentRequestTasker->tasker_id);
        $query->whereIn('assignment_request_taskers.status', [
            AssignmentRequestTasker::STATUS_EMPLOYER_ACCEPTED,
            AssignmentRequestTasker::STATUS_TASKER_ACCEPTED
        ]);

        return $query->exists();
    }
}
