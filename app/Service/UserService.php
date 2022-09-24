<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findUserForSocialite($user, $provider)
    {
        if ($user->getEmail()) {
            $user = $this->userRepository->findUserByEmail($user->getEmail());
        } else {
            $user = $this->userRepository->findUserById($user->getId(), $provider);
        }
        return $user;
    }

    public function userSocialiteUpdate($userSocialite, $user, $provider)
    {
        return $this->userRepository->userSocialiteUpdate($userSocialite, $user, $provider);
    }

    public function userSocialiteCreate($user, $provider)
    {
        return $this->userRepository->userSocialiteCreate($user, $provider);
    }
}
