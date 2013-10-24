<?php
namespace Phpcon2013\Security;

class Hasher {
    /** @var  string */
    private $salt;

    function __construct($salt)
    {
        $this->salt = $salt;
    }

    public function hash($string)
    {
        $stringWithSalt = $this->salt . $string;
        return hash('sha256', $stringWithSalt);
    }
}