<?php

namespace App\Http\Controllers\Api\Employer\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employer\Invoice\PayInvoiceRequest;
use App\Http\Requests\Api\Employer\Invoice\PayTaskerAmountRequest;
use App\Http\Requests\Api\Employer\Task\PayTaskRequest;
use App\Models\Invoice;
use App\Models\Task;
use App\Repositories\InvoiceRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class PayTaskController extends Controller
{
    public function __invoke(PayTaskRequest $request, Task $task, TaskRepository $taskRepository)
    {
        return $taskRepository->payTaskerAmount($task, $request->paymentType(), $request->creditCard());
    }
}
