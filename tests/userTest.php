<?php
/**
 * Created by PhpStorm.
 * User: conorsimpson
 * Date: 02/05/2016
 * Time: 22:19
 */


namespace Hdip\Model;

;

class userTest extends \PHPUnit_Framework_TestCase
{

    public function dbConfig()
    {
        define('DB_HOST', 'localhost');
        define('DB_USER', 'conor');
        define('DB_PASS', 'simpson');
        define('DB_NAME', 'graphicgames');
    }
    public function testGetUserId()
    {
        // Arrange
        $user = new User();
        $user->setId(1);
        $expectedResult = 1;

        // Act
        $result = $user->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetUsername()
    {
        // Arrange
        $user = new User();
        $user->setUsername("conor");
        $expectedResult = "conor";

        // Act
        $result = $user->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetPassword()
    {
        // Arrange
        $user = new User();
        $user->setPassword("simpson");
        $expectedResult = true;

        // Act
        $password = $user->getPassword();
        $result = password_verify("simpson", $password);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetRole()
    {
        // Arrange
        $user = new User();
        $user->setRole(1);
        $expectedResult = "1";

        // Act
        $result = $user->getRole();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCanFindMatchingUsernameAndPassword()
    {
        $this->dbConfig();
        // Arrange
        $user = new User();
        $user->setId(1);
        $user->setUsername("conor");
        $user->setPassword("simpson");
        $user->setRole(1);

        // Act
        $result = $user->canFindMatchingUsernameAndPassword("conor", "simpson");

        // Assert
        $this->assertTrue($result);
    }
/*
    public function testCantFindMatchingUsernameAndPassword()
    {
        // Arrange
        $user = new User();

        // Act
        $result = $user->canFindMatchingUsernameAndPassword("conor", "simpson");

        // Assert
        $this->assertFalse($result);
    }


*/
}
