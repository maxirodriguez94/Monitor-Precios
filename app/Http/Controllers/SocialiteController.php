<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\UserService;
use Laravel\Socialite\Facades\Socialite;


class SocialiteController extends Controller
{
    private $availableDrivers = [
        'facebook',  'google'
    ];

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

        $user = $this->userService->findUserForSocialite($userSocialite, $provider);

        if ($user) {
            $user = $this->userService->userSocialiteUpdate($userSocialite, $user, $provider);
        } else {
            $user = $this->userService->userSocialiteCreate($userSocialite, $provider);
        }

        auth()->login($user, true);
        return redirect()->route('home');
    }
}
