<?php
use Phpcon2013\Authentication\Authenticator;

class AuthenticatorTest extends PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function shouldNotAuthenticateUserWithEmptyPassword() {
        $authenticator = new Authenticator();
        $emptyLogin = '';
        $anyPassword = 'anypassword';
        $result = $authenticator->authenticate($emptyLogin, $anyPassword);
        $this->assertFalse($result);
    }
}
