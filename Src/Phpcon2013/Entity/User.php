<?php
namespace Phpcon2013\Entity;

class User {
    private $id;
    private $login;
    private $passwordHash;

    function __construct($id, $login, $passwordHash)
    {
        $this->id = $id;
        $this->login = $login;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }
}