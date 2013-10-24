<?php
use Phpcon2013\Security\Hasher;

class HasherTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function shouldGenarateSha256ForGivenString() {
        $hasher = new Hasher('');
        $hash = $hasher->hash("String to hash");
        $this->assertEquals('d4476d30fd94c746eb38d8a1b3931aa81d1e485be5a6362f47598017a91cb5d2', $hash);
    }

    /**
     * @test
     */
    public function shouldGenerateDifferentHashesForDifferentSalts() {
        $hasher = new Hasher('salt1');
        $hashForSalt1 = $hasher->hash("String to hash");

        $hasher = new Hasher('salt2');
        $hashForSalt2 = $hasher->hash("String to hash");

        $this->assertNotEquals($hashForSalt1, $hashForSalt2);
    }
}
