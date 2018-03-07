<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('spotify')->redirect();
    }

    public function handleProviderCallback()
    {
        $socialite = Socialite::driver('spotify')->user();

        $expires = new DateTime();
        $expires->modify("+{$socialite->expiresIn} seconds");

        $user = Auth::user();
        $user->access_token = $socialite->token;
        $user->expires = $expires;
        $user->refresh_token = $socialite->refreshToken;
        $user->save();

        return Redirect::to('/home');
    }
}