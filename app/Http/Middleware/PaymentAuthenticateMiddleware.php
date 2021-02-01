<?php
/**
 * User: amir
 * Date: 7/28/20
 * Time: 1:57 PM
 */

namespace App\Http\Middleware;

use App\Payment\PaymentAuthenticationHandler;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PaymentAuthenticateMiddleware
{
    /**
     * @var PaymentAuthenticationHandler
     */
    private $authenticationHandler;

    public function __construct(PaymentAuthenticationHandler $authenticationHandler)
    {
        $this->authenticationHandler = $authenticationHandler;
    }

    public function handle(Request $request, Closure $next, ...$guards)
    {
        if ($request->routeIs('payment.credit_card.initialize', 'payment.credit_card.create')) {
            $user = $this->authenticationHandler->fetchUser($request);

            if (!$user) {
                abort(Response::HTTP_UNAUTHORIZED);
            }

            if (Auth::guest() || Auth::user()->id !== $user->id) {
                Auth::login($user);
            }
        }

        return $next($request);
    }
}
