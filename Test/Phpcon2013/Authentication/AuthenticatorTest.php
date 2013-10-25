<?php

use Phpcon2013\Authentication\Authenticator;

class AuthenticatorTest extends PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function shouldNotAuthenticateUserWithEmptyLogin() {
        $authenticator = new Authenticator();
        $result = $authenticator->authenticate('','password');
        $this->assertFalse($result);
    }
}
