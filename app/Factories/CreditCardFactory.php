<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 4:18 AM
 */

namespace App\Factories;


use App\Models\Auth\User;
use App\Models\CreditCard;
use App\Repositories\Auth\UserRepository;
use App\Repositories\CreditCardRepository;
use BeSaah\TapPayments\Client;
use BeSaah\TapPayments\DTO\Customer\CustomerRequest;
use Webmozart\Assert\Assert;

class CreditCardFactory
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CreditCardRepository
     */
    private $cardRepository;

    public function __construct(
        Client $client,
        UserRepository $userRepository,
        CreditCardRepository $cardRepository
    ) {
        $this->client = $client;
        $this->userRepository = $userRepository;
        $this->cardRepository = $cardRepository;
    }

    public function create(User $user, string $tapToken): CreditCard
    {
        if (!$user->tap_customer_id) {
            $this->userRepository->createTapCustomer($user);
            $user->save();
        }

        $card = $this->client->saveCard($user->tap_customer_id, $tapToken);

        if ($this->cardRepository->belongsToUser($user, $card->getFingerprint())) {
            throw new \LogicException("duplicate_card_for_other_users");
        }

        /** @var CreditCard $creditCard */
        $creditCard = $this->cardRepository->getByColumn($card->getId(), 'tap_card_id');

        if ($creditCard) {
            throw new \LogicException("duplicate_card_for_yourself");
        }

        $creditCard = new CreditCard([
            'brand' => $card->getBrand(),
            'name' => $card->getName(),
            'first_six' => $card->getFirstSix(),
            'last_four' => $card->getLastFour(),
            'tap_card_id' => $card->getId(),
            'fingerprint' => $card->getFingerprint(),
        ]);
        $creditCard->user()->associate($user);
        $creditCard->save();

        return $creditCard;
    }
}
