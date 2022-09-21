<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;


class SocialiteController extends Controller
{

    private $availableDrivers = [
        'facebook',  'google'
    ];

    public function redirectToProvider($provider)
    {
        if (!in_array($provider, $this->availableDrivers)) {
            return redirect()->route('login');
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, $this->availableDrivers)) {
            return redirect()->route('login');
        }

        $userSocialite = Socialite::driver($provider)->stateless()->user();

        if ($userSocialite->getEmail()) {
            $user = User::where('email', $userSocialite->getEmail())->first();
        } else {
            $user = User::where($provider . '_id', $userSocialite->getId())->first();
        }

        if ($user) {
            $user->update([
                'name' => $userSocialite->getName(),
                $provider . '_id' => $userSocialite->getId(),
                'avatar' => $userSocialite->getAvatar(),
                'nick' => $userSocialite->getNickname(),
            ]);
        } else {
            $user = User::create([
                'name' => $userSocialite->getName(),
                'email' => $userSocialite->getEmail(),
                'password' => '',
                $provider . '_id' => $userSocialite->getId(),
                'avatar' => $userSocialite->getAvatar(),
                'nick' => $userSocialite->getNickname(),
            ]);
        }



        auth()->login($user, true);
        return redirect()->route('home');
    }
}
