<?php
/**
 * User: amir
 * Date: 5/7/20
 * Time: 4:18 AM
 */

namespace App\Factories;


use App\Models\Auth\User;
use App\Models\TaskerBankAccount;
use App\Repositories\Auth\UserRepository;
use BeSaah\TapPayments\Client;
use Webmozart\Assert\Assert;

class BankAccountFactory
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(Client $client, UserRepository $userRepository)
    {
        $this->client = $client;
        $this->userRepository = $userRepository;
    }

    public function create(User $user, array $data): TaskerBankAccount
    {
        Assert::eq($user->user_type, 'tasker');

        $hasDefault = $user->user_attributes->tasker_bank_accounts()->where('default', true)->exists();

        $bankAccount = new TaskerBankAccount([
            'iban' => $data['iban'],
            'bank_name' => $data['bank_name'],
            'default' => $hasDefault ? null : true,
        ]);
        $bankAccount->tasker_attributes()->associate($user->user_attributes);
        $bankAccount->save();

        return $bankAccount;
    }
}
