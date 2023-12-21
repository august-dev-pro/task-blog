<?php

namespace August\Services;

use August\Repositorys\UserRepository;

class UserService
{
    private $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function getUserById($userId)
    {
        $newUser = $this->userRepository->getUserById($userId);
        return $newUser;
    }

    public function registerUser($user)
    {
        $resultat = $this->userRepository->registerUser($user);
        return $resultat;
    }

    public function authentificateUser($user)
    {
        $resultat = $this->userRepository->authentificateUser($user);
        return $resultat;
    }

    public function authentificateAdministrator($administrator)
    {
        $resultat = $this->userRepository->authentificateAdministrator($administrator);
        return $resultat;
    }
}
