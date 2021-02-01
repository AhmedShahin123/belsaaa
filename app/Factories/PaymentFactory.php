<?php
/**
 * User: amir
 * Date: 5/23/20
 * Time: 3:33 AM
 */

namespace App\Factories;


use App\Models\CreditCard;
use App\Models\Invoice;
use App\Models\Payment;
use BeSaah\TapPayments\Client;
use BeSaah\TapPayments\DTO\Authorize\AuthorizeRequest;
use BeSaah\TapPayments\DTO\Customer;
use Illuminate\Support\Collection;
use Webmozart\Assert\Assert;

class PaymentFactory
{
    /**
     * @var Client
     */
    private $tapPaymentClient;

    public function __construct(Client $tapPaymentClient)
    {
        $this->tapPaymentClient = $tapPaymentClient;
    }

    /**
     * @param CreditCard $card
     * @param string $target
     * @param Collection|Invoice[] $invoices
     * @return Payment
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function create(CreditCard $card, string $target, $invoices): Payment
    {
        Assert::notEmpty($invoices);

        $payment = Payment::create([
            'status' => Payment::STATUS_PENDING,
            'target' => $target,
            'amount' => 0,
            'credit_card_id' => $card->id,
        ]);

        $amount = 0;
        foreach ($invoices as $invoice) {
            $payment->invoices()->attach($invoice->id);

            if (in_array($target, [Payment::TARGET_TASKER_AMOUNT, Payment::TARGET_FULL])) {
                $amount += $invoice->tasker_amount;
            }

            if (in_array($target, [Payment::TARGET_COMMISSION, Payment::TARGET_FULL])) {
                $amount += $invoice->commission;
            }
        }
        $payment->fill(['amount' => $amount]);
        $payment->save();

        $authorizeResponse = $this
            ->tapPaymentClient
            ->authorize($payment->amount, $card->user->tap_customer_id, $card->tap_card_id, $payment->id);

        $details = $payment->details;
        $details['redirect_url'] = $authorizeResponse->getTransaction()->getUrl();
        $details['authorize_id'] = $authorizeResponse->getId();
        $payment->details = $details;
        $payment->save();

        return $payment;
    }
}
