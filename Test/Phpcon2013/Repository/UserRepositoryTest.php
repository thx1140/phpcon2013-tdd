<?php
use Phpcon2013\Repository\UserRepository;

class UserRepositoryTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function shouldFindExistingUserByLogin() {
        $usersCollection = array(
            "existingLogin" => array("id" => 101, "login" => "existingLogin", "passwordHash" => "passwordHash1"),
            "existingLogin2" => array("id" => 102, "login" => "existingLogin2", "passwordHash" => "passwordHash2")
        );
        $userRepository = new UserRepository($usersCollection);

        $existingUserLogin1 = 'existingLogin';
        /** @var User $user */
        $user = $userRepository->findByLogin($existingUserLogin1);
        $this->assertEquals('existingLogin', $user->getLogin());
    }

    /**
     * @test
     */
    public function shouldReturnNullOnNotExistingUser() {
        $usersCollection = array();
        $userRepository = new UserRepository($usersCollection);
        $user = $userRepository->findByLogin("notExistingUserLogin");
        $this->assertNull($user);
    }

    /**
     * @test
     */
    public function foundUserShoulContainAllProperties() {
        $usersCollection = array(
            "existingLogin" => array("id" => 101, "login" => "existingLogin", "passwordHash" => "passwordHash"),
        );
        $userRepository = new UserRepository($usersCollection);

        $existingUserLogin1 = 'existingLogin';
        /** @var User $user */
        $user = $userRepository->findByLogin($existingUserLogin1);
        $this->assertEquals(101, $user->getId());
        $this->assertEquals('existingLogin', $user->getLogin());
        $this->assertEquals('passwordHash', $user->getPasswordHash());
    }
}
