<?php

namespace App\Http\Controllers\Api\Employer\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employer\Invoice\PayInvoiceRequest;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;

class PayInvoiceController extends Controller
{
    public function __invoke(PayInvoiceRequest $request, Invoice $invoice, InvoiceRepository $invoiceRepository)
    {
        return $invoiceRepository->pay($invoice, $request->paymentType(), $request->creditCard());
    }
}
