<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;

use App\Models\Auth\User;
use App\Models\CreditCard;

class CreditCardRepository extends BaseRepository
{
    public function __construct(CreditCard $model)
    {
        $this->model = $model;
    }

    public function getForUserById(User $user, $id): ?CreditCard
    {
        return $user->credit_cards()->getQuery()->byId($id)->first();
    }

    public function paginateByUser(User $user, $limit = 25, array $columns = ['*'], $pageName = 'page', $page = null)
    {
        $query = $this->model->newQuery();
        $query->byUserId($user->id);

        return $query->paginate($limit, $columns, $pageName, $page);
    }

    public function belongsToOtherUser(User $user, $fingerprint)
    {
        $query = $this->model->newQuery();
        $query->byOtherUserId($user->id)->byFingerprint($fingerprint);

        return $query->exists();
    }

    public function belongsToUser(User $user, $fingerprint)
    {
        $query = $this->model->newQuery();
        $query->byUserId($user->id)->byFingerprint($fingerprint);

        return $query->exists();
    }
}
