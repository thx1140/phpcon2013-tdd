<?php
namespace Phpcon2013\Repository;

use Phpcon2013\Entity\User;

class UserRepository {
    /** @var array  */
    private $usersCollection;

    function __construct(array $usersCollection)
    {
        $this->usersCollection = $usersCollection;
    }

    /**
     * @param $userLogin
     * @return null|User
     */
    public function findByLogin($userLogin)
    {
        $user = null;
        if($this->userExists($userLogin)) {
            $user = $this->createUser($userLogin);
        }
        return $user;
    }

    /**
     * @param $userLogin
     * @return bool
     */
    private function userExists($userLogin)
    {
        return !empty($this->usersCollection[$userLogin]);
    }

    /**
     * @param $userLogin
     * @return User
     */
    private function createUser($userLogin)
    {
        $userEntity = $this->usersCollection[$userLogin];
        $user = new User($userEntity["id"],
            $userEntity["login"],
            $userEntity["passwordHash"]
        );
        return $user;
    }

    public function findByLoginAndPasswordHash($login, $hash)
    {
        $user = null;
        if($this->userExists($login)) {
            $user = $this->createUser($login);
            if($user->getPasswordHash() != $hash) {
                $user = null;
            }
        }
        return $user;
    }
}