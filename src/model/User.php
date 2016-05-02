<?php
/**
 * this file is used for the user
 */
namespace Hdip\model;

/**
 * summary for the use statements
 */
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;

/**
 * this class is for the user to connect to database
 * Class User
 * @package Hdip\model
 */
class User extends DatabaseTable
{
    /**
     *
     */
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;

    /**
     * is
     * @var int
     */
    private $id;
    /**
     * username
     * @var string
     */
    private $username;
    /**
     * password
     * @var string
     */
    private $password;
    /**
     * role
     * @var int
     */
    private $role;

    /**
     * gets user id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * sets user
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * gets username
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * sets username
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * gets password
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * gets role
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * sets role
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * hash the password before storing ...
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;
    }

    /**
     * return success (or not) of attempting to find matching username/password in the repo
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public static function canFindMatchingUsernameAndPassword($username, $password)
    {
        $user = User::getOneByUsername($username);

        // if no record has this username, return FALSE
        if (null == $user) {
            return false;
        }

        // hashed correct password
        $hashedStoredPassword = $user->getPassword();

        // return whether or not hash of input password matches stored hash
        return password_verify($password, $hashedStoredPassword);
    }

    /**
     * if record exists with $username, return User object for that record
     * otherwise return 'null'
     *
     * @param $username
     *
     * @return mixed|null
     */
    public static function getOneByUsername($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM users WHERE username=:username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }
}
