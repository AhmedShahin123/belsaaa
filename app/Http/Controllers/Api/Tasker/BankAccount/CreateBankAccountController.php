<?php

namespace App\Http\Controllers\Api\Tasker\BankAccount;

use App\Factories\BankAccountFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\BankAccount\CreateBankAccountRequest;
use Illuminate\Http\Request;

class CreateBankAccountController extends Controller
{
    public function __invoke(CreateBankAccountRequest $request, BankAccountFactory $bankAccountFactory)
    {
        return $bankAccountFactory->create($this->user(), $request->validated());
    }
}
