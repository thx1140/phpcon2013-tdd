<?php

use Phpcon2013\Authentication\Authenticator;
use Phpcon2013\Security\Hasher;
use Phpcon2013\Repository\UserRepository;
use Phpcon2013\Entity\User;

class AuthenticatorTest extends PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function shouldNotAuthenticateUserWithEmptyLogin() {
        $authenticator = new Authenticator(new Hasher(''), new UserRepository(array()));
        $result = $authenticator->authenticate('','password');
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldAuthenticateUserWithCorrectCredentials() {

        $hasherMockBuilder = $this->getMockBuilder('Phpcon2013\Security\Hasher');
        $hasherMockBuilder->disableOriginalConstructor();
        $hasherMockBuilder->setMethods(array('hash'));
        $hasherMock = $hasherMockBuilder->getMock();
        $hasherMock->expects($this->atLeastOnce())
            ->method('hash')
            ->with('correctPassword')
            ->will($this->returnValue('hashedPassword'));

        $userRepositoryMockBuilder = $this->getMockBuilder('Phpcon2013\Repository\UserRepository');
        $userRepositoryMockBuilder->disableOriginalConstructor();
        $userRepositoryMock = $userRepositoryMockBuilder->getMock();
        $userRepositoryMock->expects($this->atLeastOnce())
            ->method('findByLoginAndPasswordHash')
            ->with('login', 'correctPassword')
            ->will($this->returnValue(new User(1,'login','hashedPassword')));

        $authenticator = new Authenticator($hasherMock, $userRepositoryMock);
        $result = $authenticator->authenticate('login', 'correctPassword');
        $this->assertTrue($result);
    }
}
