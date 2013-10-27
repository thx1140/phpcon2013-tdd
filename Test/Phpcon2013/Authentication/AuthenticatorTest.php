<?php


use Phpcon2013\Authentication\Authenticator;
use Phpcon2013\Security\Hasher;
use Phpcon2013\Repository\UserRepository;
use Phpcon2013\Entity\User;


class AuthenticatorTest extends PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function shouldNotAuthenticateUserWithEmptyPassword() {
        $authenticator = new Authenticator(new Hasher(''), new UserRepository(array()));
        $emptyLogin = '';
        $anyPassword = 'anypassword';
        $result = $authenticator->authenticate($emptyLogin, $anyPassword);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldAuthenticateUserWithCorrectCredentials() {

        $hasherMock = $this->getMock('Phpcon2013\Security\Hasher', array(), array(), '', false);
        $hasherMock->expects($this->atLeastOnce())
            ->method('hash')
            ->with('correctPassword')
            ->will($this->returnValue('hashedPassword'));

        $userRepositoryMock = $this->getMock('Phpcon2013\Repository\UserRepository', array(), array(), '', false);
        $userRepositoryMock->expects($this->atLeastOnce())
            ->method('findByLoginAndPasswordHash')
            ->with('login', 'hashedPassword')
            ->will($this->returnValue(new User(1,'login','hashedPassword')));

        $authenticator = new Authenticator($hasherMock, $userRepositoryMock);
        $result = $authenticator->authenticate('login', 'correctPassword');
        $this->assertTrue($result);
    }
}
