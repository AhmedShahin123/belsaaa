<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 4:46 AM
 */

namespace App\Http\Controllers\Api\Tasker\CreditCard;


use App\Http\Controllers\Api\Controller;
use App\Repositories\CreditCardRepository;

class IndexCreditCardController extends Controller
{
    public function __invoke(CreditCardRepository $repository)
    {
        return $repository->paginate();
    }
}
