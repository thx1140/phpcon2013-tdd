<?php

namespace Phpcon2013\Authentication;
use Phpcon2013\Repository\UserRepository;
use Phpcon2013\Security\Hasher;

class Authenticator {
    /** @var  Hasher */
    private $hasher;

    /** @var UserRepository  */
    private $userRepository;

    public function __construct(UserRepository $userRepository, Hasher $hasher)
    {
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
    }


    public function authenticate($login, $password)
    {
        if (empty($login)) {
            return false;
        }
        $hashedPassword = $this->hasher->hash($password);
        $user = $this->userRepository->findByLoginAndPasswordHash($login, $hashedPassword);
        if($user !== null) {
            return true;
        }
    }
}