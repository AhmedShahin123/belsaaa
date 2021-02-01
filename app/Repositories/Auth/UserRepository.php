<?php
/**
 * User: amir
 * Date: 1/28/20
 * Time: 4:23 PM
 */

namespace App\Repositories\Auth;


use App\Factories\Auth\EmployerAttributesFactory;
use App\Factories\Auth\TaskerAttributesFactory;
use App\Factories\TaskerWorkingDayFactory;
use App\Helpers\General\PhoneNumberHelper;
use App\Models\AssignmentRequestTasker;
use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\TaskerWorkingDay;
use App\Models\Auth\User;
use App\Models\Interfaces\AssignmentRequestTaskerInterface;
use App\Models\Interfaces\TaskInterface;
use App\Models\Task;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Repositories\BaseRepository;
use BeSaah\TapPayments\Client;
use BeSaah\TapPayments\DTO\Customer\CustomerRequest;
use BeSaah\TapPayments\DTO\Phone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Hashing\HashManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Webmozart\Assert\Assert;

/**
 * Class UserRepository
 */
class UserRepository extends BaseRepository
{
    /**
     * @var EmployerAttributesFactory
     */
    private $employerAttributesFactory;

    /**
     * @var TaskerAttributesFactory
     */
    private $taskerAttributesFactory;

    /**
     * @var PhoneNumberHelper
     */
    private $phoneNumberHelper;

    /**
     * @var HashManager
     */
    private $hashManager;

    /**
     * @var TaskerWorkingDayFactory
     */
    private $taskerWorkingDayFactory;

    /**
     * @var Client
     */
    private $tapClient;

    /**
     * UserRepository constructor.
     *
     * @param User                      $model
     * @param EmployerAttributesFactory $employerAttributesFactory
     * @param TaskerAttributesFactory   $taskerAttributesFactory
     * @param PhoneNumberHelper         $phoneNumberHelper
     * @param HashManager               $hashManager
     * @param TaskerWorkingDayFactory   $taskerWorkingDayFactory
     * @param CLient                    $tapClient
     */
    public function __construct(
        User $model,
        EmployerAttributesFactory $employerAttributesFactory,
        TaskerAttributesFactory $taskerAttributesFactory,
        PhoneNumberHelper $phoneNumberHelper,
        HashManager $hashManager,
        TaskerWorkingDayFactory $taskerWorkingDayFactory,
        Client $tapClient
    ) {
        $this->model = $model;
        $this->employerAttributesFactory = $employerAttributesFactory;
        $this->taskerAttributesFactory = $taskerAttributesFactory;
        $this->phoneNumberHelper = $phoneNumberHelper;
        $this->hashManager = $hashManager;
        $this->taskerWorkingDayFactory = $taskerWorkingDayFactory;
        $this->tapClient = $tapClient;
    }

    /**
     * @param string $type
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return User|mixed
     */
    public function create($type, array $data)
    {
        Assert::oneOf($type, ['employer', 'tasker']);

        return \DB::transaction(function () use ($type, $data) {
            /** @var User $user */
            $user = $this->model::create([
                'first_name' => $data['first_name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'company_name' => $data['company_name'] ?? null,
                'email' => $data['email'],
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'active' => true,
                'password' => $data['password'],
                'cellphone' => phone($data['cellphone'], ['SA', 'IR'], PhoneNumberFormat::E164),
                // If users require approval or needs to confirm email
                'confirmed' => ! (config('access.users.requires_approval') || config('access.users.confirm_email')),
                'location' => [
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                ]
            ]);

            if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
                $user->addMedia($data['photo'])->toMediaCollection('profile');
            }

            if ($user) {
                // Add the default site role to the new user
                $user->assignRole(config('access.users.default_role'));
                $user->user_attributes()->associate($this->createUserAttributes($type, $data['attributes']));

                if ($user->user_type) {
                    $this->createTapCustomer($user);
                }

                $user->save();
            }

            /*
             * If users have to confirm their email and this is not a social account,
             * and the account does not require admin approval
             * send the confirmation email
             *
             * If this is a social account they are confirmed through the social provider by default
             */
            if (config('access.users.confirm_email')) {
                // Pretty much only if account approval is off, confirm email is on, and this isn't a social account.
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));
            }

            // Return the user object
            return $user;
        });
    }

    public function findByCredentials($credential): ?User
    {
        $query = $this->model->newQuery();
        $query->where(function (Builder $q) use ($credential){
            $q
                ->where('email', $credential)
                ->orWhere('cellphone', $this->phoneNumberHelper->normalizeCellphone($credential))
            ;
        });

        return $query->first();
    }

    public function findByCellphone($cellphone): ?User
    {
        $query = $this->model->newQuery();
        $query->where(function (Builder $q) use ($cellphone){
            $q
                ->where('cellphone', $this->phoneNumberHelper->normalizeCellphone($cellphone))
            ;
        });

        return $query->first();
    }

    public function verifyPassword(User $user, $password)
    {
        return $this->hashManager->check($password, $user->getAuthPassword());
    }

    public function updateEmployer(User $employer, array $attributes)
    {
        Assert::true($employer->user_type == 'employer');

        if (isset($attributes['location'])) {
            Assert::isArray($attributes);
            Assert::keyExists($attributes['location'], 'latitude');
            Assert::keyExists($attributes['location'], 'longitude');

            $employer->update([
                'location' => $attributes['location'],
            ]);
        }

        if (isset($attributes['company_name'])) {
            $employer->forceFill(['company_name' => $attributes['company_name']]);
        }

        if (isset($attributes['email'])) {
            $employer->forceFill(['email' => $attributes['email']]);
        }

        $employer->save();

        if (isset($attributes['attributes']) && isset($attributes['attributes']['bio'])) {
            $employer->user_attributes->forceFill([
                'bio' => $attributes['attributes']['bio']
            ]);
            $employer->user_attributes->save();
        }

        if (Arr::has($attributes, 'attributes.office_photo')) {
            $oldOfficePhoto = $employer->user_attributes->getFirstMedia('office_photo');
            if ($oldOfficePhoto) {
                $oldOfficePhoto->delete();
            }
            $employer
                ->user_attributes
                ->addMedia($attributes['attributes']['office_photo'])
                ->toMediaCollection('office_photo');
        }

        if (Arr::has($attributes, 'attributes.legal_document')) {
            $oldLegalDocument = $employer->user_attributes->getFirstMedia('legal_document');
            if ($oldLegalDocument) {
                $oldLegalDocument->delete();
            }

            $employer
                ->user_attributes
                ->addMedia($attributes['attributes']['legal_document'])
                ->toMediaCollection('legal_document');
        }
    }

    private function createUserAttributes($type, $attributes)
    {
        if ($type == 'employer') {
            return $this->employerAttributesFactory->create($attributes);
        } elseif ($type == 'tasker') {
            return $this->taskerAttributesFactory->create($attributes);
        } else {
            throw new \InvalidArgumentException();
        }
    }

    public function updateTasker(User $tasker, array $data, ?array $workingDays)
    {
        DB::transaction(function() use ($tasker, $data, $workingDays) {
            $taskerAttributes = $data['attributes'] ?? [];
            unset($data['attributes']);
            $tasker->user_attributes->update($taskerAttributes);

            $tasker->update($data);

            if ($workingDays) {
                $this->updateTaskerWorkingDays($tasker, $workingDays);
            }
        });
    }

    public function updateTaskerWorkingDays(User $tasker, array $workingDays)
    {
        // We need to delete all previous working days to be overridden
        $tasker->user_attributes->working_days()->delete();

        $startDate = Carbon::now();
        if ($workingDays['repeat']) {
            $numberOfDays = 7 * 8; // 8 weeks
        } else {
            $numberOfDays = 7; // one week
        }

        $workingDays = array_reduce($workingDays['days'], function ($carry, $item) {
            $carry[$item['weekday']] = $item;

            return $carry;
        }, []);

        for ($i = 0; $i < $numberOfDays; $i++) {
            $date = (clone $startDate)->addDays($i);
            $weekday = strtolower($date->format('l'));
            if (!isset($workingDays[$weekday])) {
                continue;
            }

            if ($workingDays[$weekday]['shift_day']) {
                $this->taskerWorkingDayFactory->create(
                    $tasker->user_attributes,
                    $date,
                    'day',
                    setting('shift_day_start_time', '08:00:00'),
                    setting('shift_day_end_time', '23:59:59')
                );
            }

            if ($workingDays[$weekday]['shift_night']) {
                $this->taskerWorkingDayFactory->create(
                    $tasker->user_attributes,
                    $date,
                    'night',
                    setting('shift_night_start_time', '24:00:00'),
                    setting('shift_night_end_time', '07:59:59')
                );
            }
        }
    }

    public function randomTasker()
    {
        return $this->model->newQuery()
            ->where('user_type', 'tasker')
            ->orderByRaw('RAND()')
            ->take(2)
            ->get()
        ;
    }

    public function bestForTaskQuery(Task $task): Builder
    {
        $maxDistance = setting('requesting_tasker_distance');

        $genderWhere = $task->required_tasker_gender ? "and tasker_attributes.gender = '{$task->required_tasker_gender}'" : '';

        $sql = <<<SQL
select taskers.id
from (select users.id, users.latitude, users.longitude,
             `tasker_attributes`.worked_hours  as XE,
             `users`.average_rating            as XR,
             ((ACOS(SIN({$task->latitude} * PI() / 180) * SIN(users.latitude * PI() / 180) +
                    COS({$task->latitude} * PI() / 180) * COS(users.latitude * PI() / 180) *
                    COS(({$task->longitude} - users.longitude) * PI() / 180)) * 180 /
               PI()) * 60 * 1.1515 * 1.609344) as XD
      from `users`
               join tasker_attributes on users.attributes_id = tasker_attributes.id and users.user_type = 'tasker' {$genderWhere}
      where `users`.`deleted_at` is null) as taskers where XD between 0 and {$maxDistance} order by ((-0.5*least(4 * (taskers.XD / 20000) + 1, 5)) + (0.3*least( 4*(XE/1000) +1, 5)) + (0.2 * XR)) desc
SQL;

        $query = $this->model->newQuery();
        $query
            ->whereRaw("users.id in ($sql)")
            ->where('users.active', true)
            ->whereNotNull('users.phone_verified_at')
            ->take(setting('requesting_tasker_count') * $task->required_tasker_number);

        return $query;
    }

    public function forOneTimeTask(Task $task)
    {
        $query = $this->model->newQuery();
        $query
//            ->geofence($task->latitude, $task->longitude, 0, setting('requesting_tasker_distance'))
            ->tasker()
            ->whereNotIn('users.id', AssignmentRequestTasker::select('tasker_id as id')->where('assignment_request_taskers.task_id', $task->id))
            ->take($task->should_request_count());

        return $query->get();
    }

    public function forOneTimeTaskNew(Task $task)
    {
        Assert::oneOf($task->task_type, [
            'one_time',
            'continued',
        ]);

        $query = $this->bestForTaskQuery($task);

//        $busyUsers = $this->model->newQuery()->whereHas('busy_on_one_time_tasks')->join('task_one_time_attributes', 'tasks.attributes_id', '=', 'task_one_time_attributes.id')->whereDate('task_one_time_attributes.start_date', $task->task_attributes->start_date)->whereTime('task_one_time_attributes.end_time', '>=', '10:10:00')->whereTime('task_one_time_attributes.start_time', '<=', '08:00:00');


        $query->whereNotIn('users.id', function (\Illuminate\Database\Query\Builder $query) use ($task) {
            $query
                ->select('users.id')
                ->from('users')
                ->whereExists(function (\Illuminate\Database\Query\Builder $query) use ($task) {
                    $query
                        ->select('tasks.*')
                        ->from('tasks')
                        ->join('assignment_request_taskers', 'assignment_request_taskers.task_id', '=', 'tasks.id')
                        ->join('task_one_time_attributes', 'tasks.attributes_id', '=', 'task_one_time_attributes.id')
                        ->where('users.id', '=', 'assignment_request_taskers.tasker_id')
                        ->whereIn('tasks.status', [
                            TaskInterface::STATUS_SENDING,
                            TaskInterface::STATUS_ACCEPTED,
                            TaskInterface::STATUS_STARTED,
                        ])
                        ->whereIn('assignment_request_taskers.status', [
                            AssignmentRequestTaskerInterface::STATUS_PENDING,
                            AssignmentRequestTaskerInterface::STATUS_TASKER_ACCEPTED,
                            AssignmentRequestTaskerInterface::STATUS_EMPLOYER_ACCEPTED,
                        ])
                    ;

                    if ($task->task_type === 'one_time') {
                        $query
                            ->where('tasks.task_type', 'one_time')
                            ->whereDate('task_one_time_attributes.start_date', $task->task_attributes->start_date)
                            ->whereTime('task_one_time_attributes.end_time', '>=', $task->task_attributes->start_time)
                            ->whereTime('task_one_time_attributes.start_time', '<=', $task->task_attributes->end_time)
                        ;
                    } elseif ($task->task_type === 'continued') {
                        $query
                            ->where('tasks.task_type', 'continued')
                            ->whereDate('tasks.end_at', '>=', $task->start_at)
                            ->whereDate('tasks.start_at', '<=', $task->end_at)
                            ->whereTime('tasks.end_at', '>=', $task->start_at)
                            ->whereTime('tasks.start_at', '<=', $task->end_at)
                        ;
                    }
                })
            ;
        });

        if ($task->task_type === 'one_time') {
            $query->whereExists(function (\Illuminate\Database\Query\Builder $query) use ($task) {
                $query
                    ->select('tasker_working_days.*')
                    ->from('tasker_working_days')
                    ->whereRaw('tasker_working_days.tasker_attributes_id = users.attributes_id')
                    ->whereDate("tasker_working_days.date", $task->task_attributes->start_date)
                    ->where('tasker_working_days.start', '<=', $task->start_at->setTimezone('Asia/Riyadh')->format('H:i:s'))
                    ->where('tasker_working_days.end', '>=', $task->end_at->setTimezone('Asia/Riyadh')->format('H:i:s'))
                ;
            });
        } elseif ($task->task_type === 'continued') {
            $query->whereExists(function (\Illuminate\Database\Query\Builder $query) use ($task) {
                $query
                    ->select('tasker_attributes.*')
                    ->from('tasker_attributes')
                    ->whereRaw('tasker_attributes.id = users.attributes_id')
                    ->whereDate('tasker_attributes.available_until', '>=', $task->end_at);
            });
        }

        $query->whereNotIn('users.id', function(\Illuminate\Database\Query\Builder $query) use ($task) {
            $query->select('assignment_request_taskers.tasker_id')->from('assignment_request_taskers')->where('assignment_request_taskers.task_id', $task->id);
        });

        return $query;
    }

    public function changePassword(User $user, string $password)
    {
        $user->update(['password' => $password]);
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     * @param string $term
     *
     * @return mixed
     */
    public function getPaginatedEmployers($paged = 25, $orderBy = 'created_at', $sort = 'desc', $term = null, $activeEmployers = false) : LengthAwarePaginator
    {
        $query = $this->model
            ->newQuery()
            ->where('user_type', 'employer')
            ->orderBy($orderBy, $sort);

        if ($activeEmployers) {
            $query
                ->active()
            ;
        }

        if ($term) {
            $query->search($term);
        }

        return $query->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @param null $term
     * @return mixed
     */
    public function getPaginatedTaskers($paged = 25, $orderBy = 'created_at', $sort = 'desc', $term = null) : LengthAwarePaginator
    {
        $query = $this->model
            ->newQuery()
            ->where('user_type', 'tasker')
            ->orderBy($orderBy, $sort);

        if ($term) {
            $query->search($term);
        }

        return $query->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @param null $term
     * @return mixed
     */
    public function getPaginatedTaskersThatNotSelectedForTask(Task $task, $paged = 25, $orderBy = 'created_at', $sort = 'desc', $term = null) : LengthAwarePaginator
    {
        $query = $this->model
            ->newQuery()
            ->where('user_type', 'tasker')
            ->orderBy($orderBy, $sort);

        $query->whereNotIn('users.id', AssignmentRequestTasker::select('tasker_id as id')->where('assignment_request_taskers.task_id', $task->id));

        $query->gender($task->required_tasker_gender);

        $query
            ->active()
        ;

        if ($term) {
            $query->search($term);
        }

        return $query->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginatedAdmins($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->newQuery()
            ->whereNull('user_type')
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function updateTaskerPhoto(User $user, $photo)
    {
        return DB::transaction(function () use ($user, $photo) {
            $oldMedia = $user->getFirstMedia('profile');
            if ($oldMedia) {
                $oldMedia->delete();
            }
            if (\is_string($photo)) {
                $user->addMediaFromBase64($photo)->toMediaCollection('profile');
            } elseif ($photo instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                $user->addMedia($photo)->toMediaCollection('profile');
            }

            return $user;
        });
    }

    public function createTapCustomer(User $user)
    {
        $phoneNumber = PhoneNumberUtil::getInstance()->parse($user->cellphone);
        if ($user->user_type === 'employer') {
            $firstName = $user->company_name;
            $lastName = $user->company_name;
        } else {
            $firstName = $user->first_name;
            $lastName = $user->first_name;
        }
        $customerRequest = new CustomerRequest(
            $firstName,
            $firstName,
            $user->email,
            new Phone($phoneNumber->getCountryCode(), $phoneNumber->getNationalNumber())
        );

        $customerResponse = $this->tapClient->createCustomer($customerRequest);
        $user->tap_customer_id = $customerResponse->getId();
    }

    public function getAdmins()
    {
        return $this->model->newQuery()->role('administrator')->get();
    }
}
