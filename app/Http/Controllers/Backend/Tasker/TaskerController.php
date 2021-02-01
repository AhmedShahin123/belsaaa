<?php

namespace App\Http\Controllers\Backend\Tasker;

use App\Factories\Auth\UserFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Http\Requests\Backend\Tasker\UpdateTaskerRequest;
use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\TaskerWorkingDay;
use App\Models\Auth\User;
use App\Models\Task;
use App\Repositories\Auth\UserRepository;
use App\Repositories\CityRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use libphonenumber\PhoneNumberFormat;
use Webmozart\Assert\Assert;

class TaskerController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(AdminRequest $request)
    {
        return view('backend.tasker.index')
            ->withTaskers($this->userRepository->getPaginatedTaskers(25, 'id', 'asc', $request->query('term')));
    }

    /**
     * @param AdminRequest $request
     * @param User         $tasker
     *
     * @return mixed
     */
    public function show(AdminRequest $request, User $tasker)
    {
        Assert::isInstanceOf($tasker->user_attributes, TaskerAttributes::class);

        return view('backend.tasker.show')
            ->withTasker($tasker);
    }


    /**
     * @param AdminRequest $request
     * @param UserFactory  $userFactory
     *
     * @return mixed
     */
    public function create(AdminRequest $request, UserFactory $userFactory)
    {
        $tasker = $userFactory->initialize(['user_type' => 'tasker']);

        return view('backend.tasker.create')
            ->withTasker($tasker);
    }

    /**
     * @param UpdateTaskerRequest $request
     * @param UserFactory $userFactory
     *
     * @return mixed
     */
    public function store(UpdateTaskerRequest $request, UserFactory $userFactory)
    {
        $data = $request->validated();
        $data['user_type'] = 'tasker';
        $attributes = $data['user_attributes'];
        unset($data['user_attributes']);
        $data['cellphone'] = phone($data['cellphone'], ['SA', 'IR'], PhoneNumberFormat::E164);
        $userFactory->create($data, $attributes);

        return redirect()->route('admin.tasker.index')->withFlashSuccess(__('alerts.backend.tasker.created'));
    }

    /**
     * @param AdminRequest    $request
     * @param User            $tasker
     *
     * @return mixed
     */
    public function edit(AdminRequest $request, User $tasker)
    {
        Assert::isInstanceOf($tasker->user_attributes, TaskerAttributes::class);

        return view('backend.tasker.edit')
            ->withTasker($tasker);
    }

    public function update(UpdateTaskerRequest $request, User $tasker, TaskRepository $userRepository)
    {
        $data = $request->validated();
        $attributes = $data['user_attributes'];
        unset($data['user_attributes']);

        $userRepository->updateTasker($tasker, $data, $attributes);

        return redirect()->route('admin.tasker.index')->withFlashSuccess(__('alerts.backend.tasker.updated'));
    }

    public function workingDays()
    {
        $query = TaskerWorkingDay::query();
        if (request()->query('full_data')) {
            $query->with('tasker_attributes.tasker');
        }

        return response()->json($query->paginate(500));
    }
}
