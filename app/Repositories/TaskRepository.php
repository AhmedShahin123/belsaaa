<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;


use App\Factories\AssignmentRequestTaskerFactory;
use App\Factories\PaymentFactory;
use App\Factories\TaskFactory;
use App\Models\AssignmentRequestTasker;
use App\Models\Auth\EmployerAttributes;
use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\User;
use App\Models\CreditCard;
use App\Models\Interfaces\PaymentInterface;
use App\Models\Interfaces\TaskInterface;
use App\Models\Invoice;
use App\Models\Task;
use App\TaskerLocator\TaskerLocatorRegistry;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use phpDocumentor\Reflection\Types\Integer;
use Throwable;
use Webmozart\Assert\Assert;
use function foo\func;

class TaskRepository extends BaseRepository
{
    /**
     * @var TaskFactory
     */
    private $taskFactory;

    /**
     * @var AssignmentRequestTaskerRepository
     */
    private $assignmentRequestTaskerRepository;

    /**
     * @var TaskerLocatorRegistry
     */
    private $taskerLocatorRegistry;

    /**
     * @var AssignmentRequestTaskerFactory
     */
    private $assignmentRequestTaskerFactory;

    /**
     * @var PaymentFactory
     */
    private $paymentFactory;

    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    public function __construct(
        Task $model,
        AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository,
        TaskFactory $taskFactory,
        TaskerLocatorRegistry $taskerLocatorRegistry,
        AssignmentRequestTaskerFactory $assignmentRequestTaskerFactory,
        PaymentFactory $paymentFactory,
        InvoiceRepository $invoiceRepository
    ) {
        $this->model = $model;
        $this->taskFactory = $taskFactory;
        $this->assignmentRequestTaskerRepository = $assignmentRequestTaskerRepository;
        $this->taskerLocatorRegistry = $taskerLocatorRegistry;
        $this->assignmentRequestTaskerFactory = $assignmentRequestTaskerFactory;
        $this->paymentFactory = $paymentFactory;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param array  $filters
     *
     * @return mixed
     */
    public function getPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc', array $filters = []) : LengthAwarePaginator
    {
        $query = $this->model
            ->newQuery()
            ->with(['city', 'employer'])
            ->parent()
            ->orderBy($orderBy, $sort);

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $query->$key($value);
            }
        }

        return $query->paginate($paged);
    }

    public function update(Task $task, array $data, array $taskAttributes = [])
    {
        return \DB::transaction(function () use ($task, $data, $taskAttributes) {
            $task->update($data);
            $task->task_attributes->update($taskAttributes);

            return $task;
        });
    }

    /**
     * @param Task $task
     *
     * @throws Throwable
     */
    public function send(Task $task)
    {
        DB::transaction(function() use ($task) {
            $task->send();
        });
    }

    /**
     * @param Task $task
     *
     * @throws Throwable
     */
    public function sendToAdmin(Task $task)
    {
        DB::transaction(function() use ($task) {
            $task->send_to_admin();
        });
    }

    /**
     * @param Task $task
     *
     * @throws Throwable
     */
    public function reject(Task $task)
    {
        DB::transaction(function() use ($task) {
            $task->reject();
        });
    }

    /**
     * @param Task $task
     *
     * @throws Throwable
     */
    public function start(Task $task)
    {
        DB::transaction(function() use ($task) {
            $task->start();
        });
    }

    /**
     * @param Task $task
     *
     * @throws Throwable
     */
    public function acceptAndStart(Task $task)
    {
        DB::transaction(function() use ($task) {
            if ($task->can_accept()) {
                $task->accept();
            }
            $task->start();
        });
    }

    /**
     * @param Task $task
     *
     * @throws Throwable
     */
    public function accept(Task $task)
    {
        DB::transaction(function() use ($task) {
            if ($task->can_accept()) {
                $task->accept();
            }
        });
    }

    /**
     * @param Task $task
     *
     * @throws Throwable
     */
    public function acceptByTaskers(Task $task)
    {
        DB::transaction(function() use ($task) {
            $task->accept_by_taskers();
        });
    }

    public function finish(Task $task)
    {
        DB::transaction(function() use ($task) {
            $task->finish();
        });
    }

    public function expire(Task $task)
    {
        DB::transaction(function() use ($task) {
            $task->expire();
        });
    }

    public function cancel(Task $task, User $canceledBy)
    {
        DB::transaction(function() use ($task, $canceledBy) {
            $task->cancel($canceledBy);
        });
    }

    public function oneTimeByFinishedQuery(): Builder
    {
        $query = $this->model->newQuery();

        $query
            ->select('tasks.*')
            ->join('task_one_time_attributes', function (JoinClause $join) {
            $join
                ->on(function (JoinClause $query) {
                    $query->whereRaw("tasks.task_type = 'one_time'")
                        ->whereRaw('tasks.attributes_id = task_one_time_attributes.id');
                });

        })
            ->whereRaw('DATE_ADD(task_one_time_attributes.start_at, INTERVAL task_one_time_attributes.duration HOUR ) > now()')
            ->where('status', Task::STATUS_STARTED)
        ;

        return $query;
    }

    /**
     * @param User   $user
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param array  $params
     *
     * @return mixed
     */
    public function getForTaskerPaginated(
        User $user,
        $paged = 25,
        $orderBy = 'created_at',
        $sort = 'desc',
        array $params = []
    ) : LengthAwarePaginator {
        $query = $this
            ->taskerTaskQuery($user)
        ;

        if (isset($params['status'])) {
            $statuses = (array) $params['status'];

            $canceledQueryCallback = null;
            if (in_array(TaskInterface::STATUS_CANCELED, $statuses)) {
                $canceledQueryCallback = function (Builder $q) use ($user) {
                    $q
                        ->where('tasks.status', TaskInterface::STATUS_CANCELED)
                        ->where(function(Builder $q0) use ($user) {
                            $q0
                                ->where(function (Builder $q1) use ($user) {
                                    $q1->whereHas('employer_accepted_requests', function ($q3) use ($user) {
                                        $q3->where('assignment_request_taskers.tasker_id', $user->id);
                                    });
                                })
                                ->orWhere(function (Builder $q2) use ($user) {
                                    $q2->whereRaw('tasks.canceled_by_id = assignment_request_taskers.tasker_id');
                                    $q2->whereHas('tasker_accepted_requests', function ($q3) use ($user) {
                                        $q3->where('assignment_request_taskers.tasker_id', $user->id);
                                    });
                                })
                            ;
                        })
                    ;

                };
            }

            $query->where(function (Builder $q) use ($statuses, $canceledQueryCallback) {
                $q->where(function (Builder $q4) use ($statuses) {
                    $q4->whereIn('tasks.status', array_diff($statuses, [TaskInterface::STATUS_CANCELED]));
                    if (array_intersect($statuses, [
                        TaskInterface::STATUS_INITIATE,
                        TaskInterface::STATUS_SENDING,
                        TaskInterface::STATUS_SELECTED_BY_TASKER,
                    ])) {
                        $q4->where('tasks.start_at', '>', Carbon::now());
                    }
                });
                if ($canceledQueryCallback) {
                    $q->orWhere($canceledQueryCallback);
                }
            });
        }

        return $query
            ->orderBy($orderBy, $sort)
            ->runnable()
            ->paginate($paged)
        ;
    }

    /**
     * @param User   $user
     * @param int    $taskId
     *
     * @return mixed
     */
    public function getForTaskerSingle(User $user, int $taskId) : ?Task
    {
        return $this
            ->taskerTaskQuery($user)
            ->where('tasks.id', $taskId)
            ->first()
        ;
    }

    /**
     * @param User   $user
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     * @param array  $params
     *
     * @return mixed
     */
    public function getForEmployerPaginated(
        User $user,
        $paged = 25,
        $orderBy = 'created_at',
        $sort = 'desc',
        array $params = []
    ) : LengthAwarePaginator {
        $query = $this->employerTaskQuery($user);


        if (isset($params['status'])) {
            $query->whereIn('tasks.status', (array) $params['status']);

            if (array_intersect((array) $params['status'], [
                TaskInterface::STATUS_INITIATE,
                TaskInterface::STATUS_SENDING,
                TaskInterface::STATUS_SELECTED_BY_TASKER,
            ])) {
                $query->where('tasks.start_at', '>', Carbon::now());
            }
        }

        if (isset($params['commission_not_paid']) && $params['commission_not_paid'] == '1') {
            $query->whereHas('commission_not_paid_invoices');
        }

        return $query
            ->runnable()
            ->orderBy($orderBy, $sort)
            ->paginate($paged)
        ;
    }

    /**
     * @param User   $user
     * @param int    $taskId
     *
     * @return mixed
     */
    public function getForEmployerSingle(User $user, int $taskId) : ?Task
    {
        return $this
            ->employerTaskQuery($user)
            ->where('tasks.id', $taskId)
            ->first()
        ;
    }

    public function sendAssignmentRequestTasker(Task $task)
    {
        if ($this->assignTasker($task)) {
            $task->update(['last_request_sent_at' => Carbon::now()]);
        }
    }

    public function allNeededTaskersBeenAccepted(Task $task)
    {
        return $task->employer_accepted_requests()->count() >= $task->required_tasker_number;
    }

    public function allNeededTaskersHasAccepted(Task $task)
    {
        return $task->tasker_accepted_requests()->count() >= ($task->required_tasker_number - $task->employer_accepted_requests()->count());
    }

    protected function taskerTaskQuery(User $user): Builder
    {
        $query = $this->model->newQuery();

        return $query
            ->select('tasks.*')
            ->join('assignment_request_taskers', 'assignment_request_taskers.task_id', '=', 'tasks.id')
            ->where('assignment_request_taskers.tasker_id', $user->id)
            ->whereIn('assignment_request_taskers.status', [AssignmentRequestTasker::STATUS_PENDING, AssignmentRequestTasker::STATUS_TASKER_ACCEPTED, AssignmentRequestTasker::STATUS_EMPLOYER_ACCEPTED]);
    }

    protected function employerTaskQuery(User $user): Builder
    {
        $query = $this->model->newQuery();

        return $query
            ->select('tasks.*')
            ->where('tasks.employer_id', $user->id);
    }

    public function updateEmployer(User $employer, array $data, array $attributes)
    {
        Assert::isInstanceOf($employer->user_attributes, EmployerAttributes::class);
        DB::transaction(function () use ($employer, $data, $attributes) {
            $employer->update($data);
            $employer->user_attributes->update($attributes);
        });
    }

    public function updateTasker(User $tasker, array $data, $attributes)
    {
        Assert::isInstanceOf($tasker->user_attributes, TaskerAttributes::class);
        DB::transaction(function () use ($tasker, $data, $attributes) {
            $tasker->update($data);
            $tasker->user_attributes->update($attributes);
        });
    }

    public function lastWeekTasks($status = 'initiate')
    {
        $dates = CarbonPeriod::create(Carbon::now()->subWeek()->format('Y-m-d'), Carbon::today()->format('Y-m-d'));

        $datesSelect = implode(' union ', array_map(function ($date) {
            return "select '{$date->format('Y-m-d')}' as date";
        }, $dates->toArray()));

        return $this->lastPeriodTasks($datesSelect, $status);
    }

    public function lastMonthTasks($status = 'initiate')
    {
        $dates = CarbonPeriod::create(Carbon::now()->subMonth()->format('Y-m-d'), Carbon::today()->format('Y-m-d'));

        $datesSelect = implode(' union ', array_map(function ($date) {
            return "select '{$date->format('Y-m-d')}' as date";
        }, $dates->toArray()));

        return $this->lastPeriodTasks($datesSelect, $status);
    }

    public function lastYearTasks($status = 'initiate')
    {
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $months[] = Carbon::now()->subMonths($i)->format('Y-m');
        }

        $datesSelect = implode(' union ', array_map(function ($date) {
            return "select '$date' as date";
        }, $months));

        return $this->lastPeriodTasks($datesSelect, $status, '%Y-%m');
    }

    public function groupByStatusCount()
    {
        return \DB::table('tasks')
            ->select(\DB::raw('count(*) as task_count, status'))
            ->where('status', '<>', 1)
            ->groupBy('status')
            ->get()
            ->toArray()
        ;
    }

    /**
     * @param int $startWithin
     *
     * @return Builder
     */
    public function byStartWithinQuery(int $startWithin = 14): Builder
    {
        $query = $this->model->newQuery();
        $query
            ->status(Task::STATUS_INITIATE)
            ->runnable()
            ->startWithinDays($startWithin);

        return $query;
    }

    /**
     * @param int $startWithin
     *
     * @return Builder
     */
    public function byFinishedQuery(): Builder
    {
        $query = $this->model->newQuery();
        $query->canFinish();

        return $query;
    }

    public function create(array $data, array $attributes, User $user): Task
    {
        return $this->taskFactory->create($data, $attributes, $user);
    }

    public function createRepeatedChildrenTasks(Task $task)
    {
        Assert::eq('repeated', $task->task_type);

        foreach ($task->task_attributes->days as $day) {
            $this->create(
                [
                    'title' => $task->title.' - '. $day->date,
                    'description' => $task->description,
                    'hour_rate' => $task->hour_rate,
                    'required_tasker_number' => $task->required_tasker_number,
                    'latitude' => $task->latitude,
                    'longitude' => $task->longitude,
                    'task_type' => 'one_time',
                    'parent_id' => $task->id,
                    'required_tasker_gender' => $task->required_tasker_gender,
                ],
                [
                    'start_date' => $day->date,
                    'start_time' => $day->start_time,
                    'end_time' => $day->end_time,
                ],
                $task->employer
            );
        }
    }

    private function lastPeriodTasks($datesSelect, $status, $dateFormat = '%Y-%m-%d')
    {
        if (db_driver() === 'mysql') {
            $dateField = "DATE_FORMAT(tasks.created_at, '$dateFormat') as date";
        } else {
            $dateField = "strftime('$dateFormat', tasks.created_at) as date";
        }
        $sql = <<<SQL
SELECT
    date_generator.date, case when count(distinct t.id) is null then 0 else count(distinct t.id) end as total
from (
         {$datesSelect}
     ) date_generator
         left join (
             select tasks.id as id, $dateField, tasks.status as status from tasks where status = '$status'
             ) t on t.date = date_generator.date
group by date_generator.date;
SQL;

        return DB::select(DB::raw($sql));
    }

    public function taskCanStart(Task $task)
    {
        return $this->byCanStartQuery()->where('id', $task->id)->count() === 1;
    }

    public function byCanStartQuery()
    {
        return $this->model->newQuery()->canStart();
    }

    public function byStartAtPassedQuery()
    {
        return $this->model->newQuery()->startAtPassed()->accepted();
    }

    public function taskCanFinish(Task $task)
    {
        return $this->byFinishedQuery()->where('id', $task->id)->count() === 1;
    }

    public function passedAndNotAccepted()
    {
        $query = $this->model->newQuery();

        $query->whereIn('status', [
            TaskInterface::STATUS_INITIATE,
            TaskInterface::STATUS_NEW,
            TaskInterface::STATUS_SENDING,
        ]);

        $query->where('start_at', '<', Carbon::now());

        return $query;
    }

    public function passedEndAtWithoutAcceptedTaskerQuery()
    {
        $query = $this->model->newQuery();

        $query->whereIn('status', [
            TaskInterface::STATUS_INITIATE,
            TaskInterface::STATUS_NEW,
            TaskInterface::STATUS_SENDING,
        ]);
        $query
            ->whereIn('task_type', [
                'one_time',
                'continued',
            ]);

        $query->where('start_at', '<', Carbon::now());
        $query->doesntHave('employer_accepted_requests');

        return $query;
    }

    public function passedStartAtWithAtLeastOneAcceptedTaskerQuery()
    {
        $query = $this->model->newQuery();

        $query->whereIn('status', [
            TaskInterface::STATUS_INITIATE,
            TaskInterface::STATUS_NEW,
            TaskInterface::STATUS_SENDING,
        ]);

        $query->where('start_at', '<=', Carbon::now());
        $query->has('employer_accepted_requests');

        return $query;
    }

    public function acceptedTasksMustStartQuery()
    {
        $query = $this->model->newQuery();

        $query->whereIn('status', [
            TaskInterface::STATUS_ACCEPTED,
        ]);

        $query->where('start_at', '<', Carbon::now()->subMinutes(30));

        return $query;
    }

    public function assignTasker(Task $task)
    {
        $taskerLocator = $this->taskerLocatorRegistry->getLocator($task);
        $taskers = $taskerLocator->locate($task);

        if ($taskers->count() == 0) {
            $this->sendToAdmin($task);

            return false;
        }

        $taskers->each(function (User $user) use ($task) {
            $this->assignmentRequestTaskerFactory->create($task, $user);
        });

        return true;
    }

    /**
     * @return Builder
     */
    public function byUnansweredByEmployerQuery(): Builder
    {
        $query = $this->model->newQuery();
        $query
            ->where('tasks.last_tasker_accepted_at', '<=', Carbon::now()->subHours(4))
            ->where('tasks.status', '=', TaskInterface::STATUS_SENDING)
            ->select('tasks.*')
        ;

        return $query;
    }

    public function payTaskerAmount(Task $task, $paymentType, ?CreditCard $creditCard)
    {
        $invoices = $task->tasker_amount_not_paid_invoices;

        return \DB::transaction(function () use ($paymentType, $invoices, $creditCard, $task) {
            if ($paymentType === Invoice::PAYMENT_TYPE_CASH) {
                foreach ($invoices as $invoice) {
                    $this->invoiceRepository->payTaskerAmount($invoice);
                    $this->invoiceRepository->clearTaskerAmount($invoice);
                }

                return $task->refresh();
            }

            return $this->paymentFactory->create($creditCard, PaymentInterface::TARGET_FULL, $invoices);
        });
    }

    private function addStatusConditionToQuery(Builder $query, $statuses)
    {
        $query->whereIn('tasks.status', (array) $statuses);

        if (array_intersect((array) $statuses, [
            TaskInterface::STATUS_INITIATE,
            TaskInterface::STATUS_SENDING,
            TaskInterface::STATUS_SELECTED_BY_TASKER,
        ])) {
            $query->where('tasks.start_at', '>', Carbon::now());
        }
    }
}
