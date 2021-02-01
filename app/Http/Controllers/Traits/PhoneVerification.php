<?php
/**
 * User: amir
 * Date: 8/8/19
 * Time: 11:32 PM
 */

namespace App\Http\Controllers\Traits;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait PhoneVerification
{
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedPhone()
            ? redirect()->route($this->getTargetRoute())
            : view(isset($this->view) ? $this->view : 'verifyphone', [
                'section' => $this->section,
                'layout' => isset($this->layout) ? $this->layout : 'layouts.app'
            ]);
    }

    public function verify(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        if (!$user->isValidVerificationCode($request->code)) {
            throw ValidationException::withMessages([
                'code' => ['The code your provided is wrong. Please try again or request another call.'],
            ]);
        }

        if ($request->user()->hasVerifiedPhone()) {
            if ($request->acceptsJson()) {
                return response()->noContent();
            } else {
                return redirect()->route($this->getTargetRoute());
            }
        }

        $request->user()->markPhoneAsVerified();

        if ($request->acceptsHtml()) {
            return redirect()->route($this->getTargetRoute())->with('status', 'Your phone was successfully verified!');
        } else {
            return response()->noContent();
        }
    }

    public function resend(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $user->callToVerify();

        if ($request->acceptsJson()) {
            return response()->noContent();
        } else {
            return redirect()->back()->with('status', 'Verification code has been sent again');
        }
    }

    public function getTargetRoute()
    {
        return request()->session()->pull('url.intended', $this->targetRoute);
    }
}
