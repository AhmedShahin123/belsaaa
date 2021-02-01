<?php

namespace App\Http\Controllers\Backend\Task;

use App\Factories\AssignmentRequestTaskerFactory;
use App\Factories\TaskFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Task\CreateTaskRequest;
use App\Http\Requests\Backend\Task\ManageTaskRequest;
use App\Http\Requests\Backend\Task\StoreTaskRequest;
use App\Http\Requests\Backend\Task\UpdateTaskRequest;
use App\Models\Auth\User;
use App\Models\Task;
use App\Repositories\Auth\UserRepository;
use App\Repositories\CityRepository;
use App\Repositories\TaskRepository;
use App\TaskerLocator\TaskerLocatorRegistry;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(ManageTaskRequest $request)
    {
        return view('backend.task.index')
            ->withTasks($this->taskRepository->getPaginated(25, 'id', 'desc', $request->query->get('filters', [])));
    }

    /**
     * @param ManageTaskRequest $request
     * @param CityRepository    $cityRepository
     * @param TaskFactory       $taskFactory
     *
     * @return mixed
     */
    public function create(CreateTaskRequest $request, CityRepository $cityRepository, TaskFactory $taskFactory)
    {
        $task = $taskFactory->initialize(['task_type' => $request->query('task_type')]);

        return view('backend.task.create')
            ->withTask($task)
            ->withCities($cityRepository->allForOptions());
    }

    public function store(StoreTaskRequest $request, TaskFactory $taskFactory, UserRepository $userRepository)
    {
        $data = $request->only([
            'title',
            'description',
            'latitude',
            'longitude',
            'city_id',
            'hour_rate',
            'required_tasker_number',
            'required_tasker_gender',
            'task_type'
        ]);

        $employerId = $request->get('employer_id');
        /** @var User $employer */
        $employer = $userRepository->getById($employerId);

        $task = $taskFactory->create($data, $request->taskAttributes(), $employer);

        return redirect()->route('admin.task.show', $task->id);
    }

    /**
     * @param ManageTaskRequest     $request
     * @param Task                  $task
     * @param UserRepository        $repository
     *
     * @return mixed
     */
    public function show(ManageTaskRequest $request, Task $task, UserRepository $repository)
    {
        $taskers = [];
        if ($task->task_type !== 'repeated') {
            $taskers = $repository->forOneTimeTaskNew($task)->paginate(100)->reduce(function ($carry, User $user) {
                $carry[$user->id] = $user->first_name.' '.$user->last_name;

                return $carry;
            }, []);
        }

        $manualAssignment = in_array($task->status, [
            Task::STATUS_INITIATE,
            Task::STATUS_SENDING,
        ]);

        return view('backend.task.show')
            ->withTask($task)
            ->withCanAssign($this->taskRepository->allNeededTaskersBeenAccepted($task))
            ->withTaskers($taskers)
            ->withManualAssignment($manualAssignment)
        ;
    }

    /**
     * @param ManageTaskRequest    $request
     * @param Task                 $task
     *
     * @return mixed
     */
    public function edit(ManageTaskRequest $request, Task $task, CityRepository $cityRepository)
    {
        if ($task->task_type === 'repeated') {
            abort(404);
        }

        return view('backend.task.edit')
            ->withTask($task)
            ->withCities($cityRepository->allForOptions());
    }

    public function update(UpdateTaskRequest $request, Task $task, TaskRepository $taskRepository)
    {
        if ($task->task_type === 'repeated') {
            abort(404);
        }

        $data = $request->only([
            'title',
            'description',
            'hour_rate',
            'required_tasker_number',
            'required_tasker_gender',
            'latitude',
            'longitude',
        ]);

        $taskRepository->update($task, $data, $request->taskAttributes());

        return redirect()->route('admin.task.index')->withFlashSuccess(__('alerts.backend.task.updated'));
    }

    /**
     * @param Task $task
     * @param Request $request
     * @param AssignmentRequestTaskerFactory $assignmentRequestTaskerFactory
     * @param UserRepository $userRepository
     * @return \Response
     * @throws \Throwable
     * @TODO refactor this method
     */
    public function assign(
        Task $task,
        Request $request,
        AssignmentRequestTaskerFactory $assignmentRequestTaskerFactory,
        UserRepository $userRepository
    ) {
        //@TODO must be refactor this shit of code
        /** @var User $tasker */
        $tasker = $userRepository->getById($request->tasker_id);
        \DB::transaction(function () use ($task, $request, $assignmentRequestTaskerFactory, $tasker) {
            $assignmentRequestTaskerFactory->create($task, $tasker);
            $task->update(['status' => 'sending']);
        });


        return redirect()->route('admin.task.show', $task->id)->withFlashSuccess(__('alerts.backend.task.tasker_assigned'));
    }
}
