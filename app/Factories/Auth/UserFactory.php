<?php
/**
 * User: amir
 * Date: 4/24/20
 * Time: 2:18 AM
 */

namespace App\Factories\Auth;


use App\Models\Auth\TaskerAttributes;
use App\Models\Auth\User;

class UserFactory
{
    /**
     * @var TaskerAttributesFactory
     */
    private $taskerAttributesFactory;

    /**
     * @var EmployerAttributesFactory
     */
    private $employerAttributesFactory;

    public function __construct(
        TaskerAttributesFactory $taskerAttributesFactory,
        EmployerAttributesFactory $employerAttributesFactory
    ) {
        $this->taskerAttributesFactory = $taskerAttributesFactory;
        $this->employerAttributesFactory = $employerAttributesFactory;
    }

    public function create(array $data = [], array $attributes = [])
    {
        return \DB::transaction(function () use ($data, $attributes) {
            $user = $this->make($data, $attributes, true);
            $user->save();

            return $user;
        });
    }

    public function initialize(array $data = [], array $attributes = [])
    {
        return $this->make($data, $attributes, false);
    }

    protected function make(array $data = [], array $attributes = [], bool $save = false)
    {
        $user = new User($data);
        if ($user->user_type == 'tasker') {
            $userAttributesFactory = $this->taskerAttributesFactory;
        } else {
            $userAttributesFactory = $this->employerAttributesFactory;
        }
        if ($save) {
            $userAttributes = $userAttributesFactory->create($attributes);
        } else {
            $userAttributes = $userAttributesFactory->initialize($attributes);
        }

        $user->user_attributes()->associate($userAttributes);

        return $user;
    }
}
