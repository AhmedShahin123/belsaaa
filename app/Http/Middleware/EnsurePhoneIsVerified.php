<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string  $section
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $section = 'frontend')
    {
        if ($request->user() && ! $request->user()->hasVerifiedPhone()) {

            if ($request->acceptsHtml()) {
                $routeName = $section.'.auth.phone_verification.show';
                $request->session()->put('url.intended', $request->route()->getName());

                return redirect()->route($routeName);
            } else {
                return response()->json([
                    'message' => 'Cellphone is not verified'
                ], Response::HTTP_FORBIDDEN);
            }


        }

        return $next($request);
    }
}
