<?php
/**
 * User: amir
 * Date: 7/28/20
 * Time: 12:58 PM
 */

namespace App\Payment;

use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Webmozart\Assert\Assert;

class PaymentAuthenticationHandler
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function generateSecuredURL(User $user, string $routeName, array $parameters = [], string $realm = 'payment')
    {
        $encrypted = Crypt::encrypt([
            'realm' => $realm,
            'user_id' => $user->id,
            'exp' => Carbon::now()->addMinutes(30)->getTimestamp(),
        ]);

        $parameters['hash'] = $encrypted;

        return config('app.url').URL::route($routeName, $parameters, false);
    }

    public function fetchUser(Request $request, string $realm = 'payment'): ?User
    {
        if (!$hash = $request->query->get('hash')) {
            return null;
        }

        try {
            $decrypted = Crypt::decrypt($hash);
        } catch (DecryptException $exception) {
            return null;
        }

        Assert::keyExists($decrypted, 'realm');
        Assert::keyExists($decrypted, 'user_id');
        Assert::keyExists($decrypted, 'exp');

        if ($decrypted['realm'] !== $realm) {
            return null;
        }

        if ($decrypted['exp'] <= Carbon::now()->getTimestamp()) {
            return null;
        }

        return $this->userRepository->getById($decrypted['user_id']);
    }
}
