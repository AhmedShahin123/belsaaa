<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 4:46 AM
 */

namespace App\Http\Controllers\Api\Employer\CreditCard;


use App\Http\Controllers\Api\Controller;
use App\Models\CreditCard;
use App\Repositories\CreditCardRepository;

class DeleteCreditCardController extends Controller
{
    public function __invoke(int $creditCardId, CreditCardRepository $repository)
    {
        $creditCard = $repository->getForUserById($this->user(), $creditCardId);

        if (!$creditCard) {
            abort(404);
        }

        $repository->deleteById($creditCardId);

        return response()->noContent();
    }
}
