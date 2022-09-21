<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userFacebook = Socialite::driver('facebook')->stateless()->user();

        $user = User::where('email', $userFacebook->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $userFacebook->getName(),
                'email' => $userFacebook->getEmail(),
                'password' => '',
                'facebook_id' => $userFacebook->getId(),
                'avatar' => $userFacebook->getAvatar(),
                'nick' => $userFacebook->getNickname(),
            ]);
        }

        auth()->login($user, true);
        return redirect()->route('home');
    }

    public function redirectGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleProviderCallback()
    {
        $userGoogle = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $userGoogle->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $userGoogle->getName(),
                'email' => $userGoogle->getEmail(),
                'password' => '',
                'google_plus_id' => $userGoogle->getId(),
                'avatar' => $userGoogle->getAvatar(),
                'nick' => $userGoogle->getNickname(),
            ]);
        }

        auth()->login($user, true);
        return redirect()->route('home');
    }
}
