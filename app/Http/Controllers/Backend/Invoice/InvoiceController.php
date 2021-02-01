<?php
/**
 * User: amir
 * Date: 8/4/20
 * Time: 12:03 PM
 */

namespace App\Http\Controllers\Backend\Invoice;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Http\Requests\Backend\Invoice\ClearTaskerAmountRequest;
use App\Http\Requests\Backend\Invoice\PayEmployerCommissionRequest;
use App\Models\Auth\User;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;

class InvoiceController extends Controller
{
    public function payCommission(AdminRequest $request, Invoice $invoice, InvoiceRepository $invoiceRepository)
    {
        $invoiceRepository->payCommission($invoice);

        return $invoice;
    }

    public function clearTaskerAmount(AdminRequest $request, Invoice $invoice, InvoiceRepository $invoiceRepository)
    {
        $invoiceRepository->clearTaskerAmount($invoice);

        return $invoice;
    }

    public function payAllEmployerCommission(PayEmployerCommissionRequest $request, User $employer, InvoiceRepository $invoiceRepository)
    {
        try {
            $invoiceRepository->payEmployerCommission($employer, $request->before_invoice_id, $request->amount);
        } catch (\LogicException $exception) {
            $request->session()->flash('flash_warning', "Your clear request didn't complete. Try again.");
            abort(400);
        }

        return $employer;
    }

    public function clearAllTaskerAmount(ClearTaskerAmountRequest $request, User $tasker, InvoiceRepository $invoiceRepository)
    {
        try {
            $invoiceRepository->clearAllTaskerAmounts($tasker, $request->before_invoice_id, $request->amount);
        } catch (\LogicException $exception) {
            $request->session()->flash('flash_warning', "Your clear request didn't complete. Try again.");
            abort(400);
        }

        return $tasker;
    }
}
