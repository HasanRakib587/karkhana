<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function authProviderRedirect($provider)
    {
        if ($provider) {
            return Socialite::driver($provider)->redirect();
        } else {
            abort(404);
        }
    }

    public function socialAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $customer = Customer::updateOrCreate(
                ['google_id' => $googleUser->getId()],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(32)),
                ]
            );

            Auth::guard('customer')->login($customer);

            return redirect()->intended(route('home'));

        } catch (\Throwable $e) {
            logger()->error('Google login failed', [
                'error' => $e->getMessage(),
            ]);

            return redirect()
                ->route('login')
                ->with('error', 'Google login failed. Please try again.');
        }
    }
}
