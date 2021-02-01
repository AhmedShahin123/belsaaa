<?php

namespace App\Http\Controllers\Api\Tasker\BankAccount;

use App\Http\Controllers\Api\Controller;
use App\Models\TaskerBankAccount;
use App\Repositories\TaskerBankAccountRepository;
use Illuminate\Http\Request;

class IndexBankAccountsController extends Controller
{
    public function __invoke(TaskerBankAccountRepository $repository)
    {
        return $repository->paginateByUser($this->user());
    }
}
