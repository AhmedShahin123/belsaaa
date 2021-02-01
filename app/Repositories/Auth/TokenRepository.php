<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories\Auth;

use App\Repositories\BaseRepository;
use Laravel\Passport\Token;

class TokenRepository extends BaseRepository
{
    public function __construct(Token $model)
    {
        $this->model = $model;
    }
}
