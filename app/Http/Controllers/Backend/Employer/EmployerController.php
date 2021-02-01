<?php

namespace App\Http\Controllers\Backend\Employer;

use App\Factories\Auth\UserFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Http\Requests\Backend\Employer\UpdateEmployerRequest;
use App\Http\Requests\Backend\Tasker\UpdateTaskerRequest;
use App\Models\Auth\EmployerAttributes;
use App\Models\Auth\User;
use App\Models\Task;
use App\Repositories\Auth\UserRepository;
use App\Repositories\CityRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use libphonenumber\PhoneNumberFormat;
use Webmozart\Assert\Assert;

class EmployerController extends Controller
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
        $employers = $this
            ->userRepository
            ->getPaginatedEmployers(25, 'id', 'asc', $request->query('term'), $request->query('active_employers', false));

        if ($request->acceptsHtml()) {
            return view('backend.employer.index')
                ->withEmployers($employers);
        }

        return response()->json($employers);
    }

    /**
     * @param AdminRequest $request
     * @param User         $employer
     *
     * @return mixed
     */
    public function show(AdminRequest $request, User $employer)
    {
        Assert::isInstanceOf($employer->user_attributes, EmployerAttributes::class);

        return view('backend.employer.show')
            ->withEmployer($employer);
    }

    /**
     * @param AdminRequest $request
     * @param UserFactory  $userFactory
     *
     * @return mixed
     */
    public function create(AdminRequest $request, UserFactory $userFactory)
    {
        $employer = $userFactory->initialize(['user_type' => 'employer']);

        return view('backend.employer.create')
            ->withEmployer($employer);
    }

    /**
     * @param UpdateEmployerRequest $request
     * @param UserFactory           $userFactory
     *
     * @return mixed
     */
    public function store(UpdateEmployerRequest $request, UserFactory $userFactory)
    {
        $data = $request->validated();
        $attributes = $data['user_attributes'];
        unset($data['user_attributes']);
        $data['cellphone'] = phone($data['cellphone'], ['SA', 'IR'], PhoneNumberFormat::E164);
        $data['location'] = [
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ];
        unset($data['latitude']);
        unset($data['longitude']);
        $userFactory->create($data, $attributes);

        return redirect()->route('admin.employer.index')->withFlashSuccess(__('alerts.backend.employer.created'));
    }

    /**
     * @param AdminRequest    $request
     * @param User            $employer
     *
     * @return mixed
     */
    public function edit(AdminRequest $request, User $employer)
    {
        Assert::isInstanceOf($employer->user_attributes, EmployerAttributes::class);

        return view('backend.employer.edit')
            ->withEmployer($employer);
    }

    public function update(UpdateEmployerRequest $request, User $employer, TaskRepository $userRepository)
    {
        $data = $request->validated();
        $attributes = $data['user_attributes'];
        unset($data['user_attributes']);
        $data['location'] = [
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ];
        unset($data['latitude']);
        unset($data['longitude']);

        $userRepository->updateEmployer($employer, $data, $attributes);

        return redirect()->route('admin.employer.index')->withFlashSuccess(__('alerts.backend.employer.updated'));
    }
}
