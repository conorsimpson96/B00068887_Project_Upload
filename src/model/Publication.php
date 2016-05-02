<?php
/**
 * summary for file
 */
namespace Hdip\model;

/**
 * summary for use
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;

/**
 * summary for class
 * Class Publication
 * @package Hdip\model
 */
class Publication extends DatabaseTable
{
    /**
     * Publication id
     * @var integer
     */
    private $id;



    /**
     * Publication author
     * @var string
     */
    private $author;

    /**
     * Publication title
     * @var string
     */
    private $title;

    /**
     * Publication url
     * @var integer
     */
    private $url;

    /**
     * Publication gets id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Publication sets id
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * Publication gets author
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Publication sets author
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }


    /**
     * Publication gets title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Publication stes title
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Publication gets url
     * @return int
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Publication sets url
     * @param int $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * searchs for author or title in database
     * @param $searchText
     * @return array
     */
   /* public static function findInAuthorOrTitle($searchText)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        // wrap wildcard '%' around the serach text for the SQL query
        $searchText = '%' . $searchText . '%';

        $sql = 'SELECT * FROM publications WHERE (title LIKE :searchText) OR (author LIKE :searchText)';

        $statement = $connection->prepare($sql);
        $statement->bindParam(':searchText', $searchText, \PDO::PARAM_STR);

        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\' . __CLASS__);
        $statement->execute();

        $publications = $statement->fetchAll();

        return $publications;
    }
   */
}
