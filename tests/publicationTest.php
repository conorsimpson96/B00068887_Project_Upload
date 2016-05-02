<?php
/**
 * Created by PhpStorm.
 * User: conorsimpson
 * Date: 02/05/2016
 * Time: 22:19
 */


namespace Hdip\Model;

class publicationTest extends \PHPUnit_Framework_TestCase
{
    public function dbConfig()
    {
        define('DB_HOST', 'localhost');
        define('DB_USER', 'conor');
        define('DB_PASS', 'simpson');
        define('DB_NAME', 'graphicgames');
    }
    public function testGetId()
    {
        // Arrange
        $publication = new Publication();
        $publication->setId(1);
        $expectedResult = 1;

        // Act
        $result = $publication->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetTitle()
    {
        // Arrange
        $publication = new Publication();
        $publication->setTitle("Graphic games volume 1");
        $expectedResult = "Graphic games volume 1";

        // Act
        $result = $publication->getTitle();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetAuthor()
    {
        // Arrange
        $publication = new Publication();
        $publication->setAuthor("conor");
        $expectedResult = "conor";

        // Act
        $result = $publication->getAuthor();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetUrl()
    {
        // Arrange
        $publication = new Publication();
        $publication->setUrl("pdf/graphic_games.pdf");
        $expectedResult = "pdf/graphic_games.pdf";

        // Act
        $result = $publication->getUrl();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
