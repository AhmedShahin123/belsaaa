<?php
/**
 * User: amir
 * Date: 7/28/20
 * Time: 12:54 PM
 */

namespace App\Http\Controllers\Api\Employer\CreditCard;


use App\Http\Controllers\Api\Controller;
use App\Payment\PaymentAuthenticationHandler;

class GetCreditCardFormLinkController extends Controller
{
    public function __invoke(PaymentAuthenticationHandler $authenticationHandler)
    {
        return response()->json(['link' => $authenticationHandler->generateSecuredURL($this->user(), 'payment.credit_card.initialize')]);
    }
}
