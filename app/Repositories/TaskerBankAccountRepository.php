<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;

use App\Models\Auth\User;
use App\Models\TaskerBankAccount;

class TaskerBankAccountRepository extends BaseRepository
{
    public function __construct(TaskerBankAccount $model)
    {
        $this->model = $model;
    }

    public function paginateByUser(User $user)
    {
        return $user->user_attributes->tasker_bank_accounts()->getQuery()->paginate();
    }

    /**
     * @param User $user
     * @param $id
     * @return TaskerBankAccount|null
     */
    public function getForUserById(User $user, $id): ?TaskerBankAccount
    {
        return $user->user_attributes->tasker_bank_accounts()->getQuery()->where('id', $id)->first();
    }

    public function makeDefault(TaskerBankAccount $bankAccount)
    {
        $bankAccount->tasker_attributes->tasker_bank_accounts()->update(['default' => null]);
        $bankAccount->update(['default' => true]);
    }
}
