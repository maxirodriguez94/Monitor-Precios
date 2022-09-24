<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function findUserByEmail($email)
    {
        return  $user = User::where('email', $email)->first();
    }

    public function findUserById($user, $provider)
    {
        return  $user = User::where($provider . '_id', $user->getId())->first();
    }

    public function userSocialiteUpdate($userSocialite, $user, $provider)
    {
        $user->update([
            'name' => $userSocialite->getName(),
            $provider . '_id' => $userSocialite->getId(),
            'avatar' => $userSocialite->getAvatar(),
            'nick' => $userSocialite->getNickname(),
        ]);
        return $user;
    }

    public function userSocialiteCreate($user, $provider)
    {
        return $user = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => '',
            $provider . '_id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'nick' => $user->getNickname(),
        ]);
    }
}
