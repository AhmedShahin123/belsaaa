<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 4:27 AM
 */

namespace App\Http\Controllers\Api\Tasker\CreditCard;

use App\Factories\CreditCardFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Common\CreditCard\CreateCreditCard;

class CreateCreditCardController extends Controller
{
    public function __invoke(CreateCreditCard $request, CreditCardFactory $factory)
    {
        return $factory->create($this->user(), $request->get('token'));
    }
}
