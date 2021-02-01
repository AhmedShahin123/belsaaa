<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:41 PM
 */

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Payment;
use BeSaah\TapPayments\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;

class PaymentRepository extends BaseRepository
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    public function __construct(Payment $model, Client $client, InvoiceRepository $invoiceRepository)
    {
        $this->model = $model;
        $this->client = $client;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function capture(Payment $payment, $authorizeId)
    {
        $failed = false;
        $chargeResponse = null;
        try {
            $chargeResponse = $this->client->charge($authorizeId, $payment->amount, $payment->invoices[0]->employer->tap_customer_id);
        } catch (ClientException $exception) {
            $failed = true;
        }

        DB::transaction(function () use ($chargeResponse, $payment, $failed) {
            if (!$failed && $chargeResponse->getStatus() === 'CAPTURED') {
                $details = $payment->details;
                $details['charge_id'] = $chargeResponse->getId();
                $details['reference'] = $chargeResponse->getReference();
                $payment->update(['status' => 'paid', 'details' => $details]);
                $this->finishPayment($payment);
            } elseif ($payment->status === Payment::STATUS_PENDING) {
                $payment->update(['status' => 'failed']);
            }
        });

        return $payment;
    }

    public function finishPayment(Payment $payment)
    {
        foreach ($payment->invoices as $invoice) {
            if (in_array($payment->target, [Payment::TARGET_TASKER_AMOUNT, Payment::TARGET_FULL])) {
                $this->invoiceRepository->payTaskerAmount($invoice);
            }

            if (in_array($payment->target, [Payment::TARGET_COMMISSION, Payment::TARGET_FULL])) {
                $this->invoiceRepository->payCommission($invoice);
            }

            $this->invoiceRepository->updatePaymentType($invoice, Invoice::PAYMENT_TYPE_ONLINE);
        }
    }
}
