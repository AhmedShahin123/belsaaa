<?php
/**
 * User: amir
 * Date: 7/28/20
 * Time: 11:51 AM
 */

namespace App\Http\Controllers\Payment;


use App\Factories\CreditCardFactory;
use App\Http\Requests\Api\Common\CreditCard\CreateCreditCard;
use Illuminate\Http\Request;

class CardController
{
    public function initialize(Request $request)
    {
        $hash = $request->query->get('hash');

        return view('payment.credit_card.initialize', compact('hash'));
    }

    public function create(CreateCreditCard $request, CreditCardFactory $factory)
    {
        $card = null;
        $error = null;
        try {
            $card =  $factory->create(\Auth::user(), $request->get('token'));
        } catch (\LogicException $exception) {
            $error = __('exceptions.'.$exception->getMessage());
        }

        return view('payment.credit_card.create', compact('card', 'error'));
    }
}
