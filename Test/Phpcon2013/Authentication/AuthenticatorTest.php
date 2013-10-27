<?php
use Phpcon2013\Authentication\Authenticator;
use Phpcon2013\Entity\User;


class AuthenticatorTest extends PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function shouldNotAuthenticateUserWithEmptyPassword() {
        $userRepositoryMock = $this->produceRepositoryMock();
        $hasherMock = $this->produceHasherMock();

        $authenticator = new Authenticator($userRepositoryMock, $hasherMock);
        $emptyLogin = '';
        $anyPassword = 'anypassword';
        $result = $authenticator->authenticate($emptyLogin, $anyPassword);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function shouldAuthenticateUserWithCorrectCredentials() {

        $hasherMock = $this->produceHasherMock();
        $hasherMock->expects($this->atLeastOnce())
            ->method('hash')
            ->with('correctPassword')
            ->will($this->returnValue('hashedPassword'));

        $userRepositoryMock = $this->produceRepositoryMock();
        $userRepositoryMock->expects($this->atLeastOnce())
            ->method('findByLoginAndPasswordHash')
            ->with('login', 'hashedPassword')
            ->will($this->returnValue(new User(1,'login','hashedPassword')));

        $authenticator = new Authenticator($userRepositoryMock, $hasherMock);
        $result = $authenticator->authenticate('login', 'correctPassword');
        $this->assertTrue($result);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function produceHasherMock()
    {
        $hasherMock = $this->getMock('Phpcon2013\Security\Hasher', array(), array(), '', false);
        return $hasherMock;
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function produceRepositoryMock()
    {
        $userRepositoryMock = $this->getMock('Phpcon2013\Repository\UserRepository', array(), array(), '', false);
        return $userRepositoryMock;
    }
}
