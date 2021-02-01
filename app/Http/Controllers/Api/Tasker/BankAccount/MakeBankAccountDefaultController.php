<?php

namespace App\Http\Controllers\Api\Tasker\BankAccount;

use App\Factories\BankAccountFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\BankAccount\CreateBankAccountRequest;
use App\Models\TaskerBankAccount;
use App\Repositories\TaskerBankAccountRepository;
use Illuminate\Http\Request;

class MakeBankAccountDefaultController extends Controller
{
    public function __invoke(TaskerBankAccountRepository $taskerBankAccountRepository, TaskerBankAccount $bankAccount)
    {
        /** @var TaskerBankAccount $bankAccount */
        $bankAccount = $this->user()->user_attributes->tasker_bank_accounts()->where('id', $bankAccount->id)->first();

        if (!$bankAccount) {
            abort(403);
        }

        $taskerBankAccountRepository->makeDefault($bankAccount);

        return $bankAccount;
    }
}
