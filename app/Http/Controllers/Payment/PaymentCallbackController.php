<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PaymentCallbackController extends Controller
{
    public function __invoke(Request $request, PaymentRepository $paymentRepository)
    {
        $authorizeId = $request->query->get('tap_id');
        $trackingId = $request->query->get('tracking_id');

        /** @var Payment $payment */
        $payment = $paymentRepository->getById($trackingId);

        if (!$payment) {
            abort(404);
        }

        $payment = $paymentRepository->capture($payment, $authorizeId);
        $invoices = $payment->invoices;

        return view('payment.callback', compact('payment', 'invoices'));
    }
}
