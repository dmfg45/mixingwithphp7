<?php


class User
{

    private $user_id;
    private $username;
    private $password;
    private $userCreated;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserCreated()
    {
        return $this->userCreated;
    }

    /**
     * @param mixed $userCreated
     */
    public function setUserCreated($userCreated): void
    {
        $this->userCreated = $userCreated;
    }

    public function loadById($id)
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM php7db.users WHERE user_id = :ID", array(
            ":ID" => $id
        ));

        if (count($result) > 0) {

            $this->setData($result[0]);

        }
    }

    public static function getList()
    {
        $sql = new Sql();
        $list = $sql->select("SELECT * FROM php7db.users ORDER BY username");
        return $list;
    }

    public static function searchUser($username)
    {
        $sql = new Sql();
        $searchUsername = $sql->select("SELECT * FROM php7db.users WHERE username LIKE :SEARCH ORDER BY username", array(
            ':SEARCH' => '%' . $username . '%'
        ));

        return $searchUsername;

    }

    public function login($username, $password)
    {
        $sql = new Sql();
        $loginUsername = $sql->select("SELECT * FROM php7db.users WHERE username LIKE :USERNAME AND password LIKE :PASSWORD", array(
            ':USERNAME' => $username,
            ':PASSWORD' => $password
        ));

        if (count($loginUsername) > 0) {
            $this->setData($loginUsername[0]);
        } else {
            throw  new Exception("Username or Password Invalid");
        }
    }

    public function setData($data)
    {
        $this->setUserId($data['user_id']);
        $this->setUsername($data['username']);
        $this->setPassword($data['password']);
        $this->setUserCreated(new DateTime($data['user_created_at']));
    }

    public function insert()
    {
        $sql = new Sql();
        $results = $sql->select("CALL sp_users_insert(:USERNAME, :PASSWORD)", array(
            'USERNAME' => $this->getUsername(),
            'PASSWORD' => $this->getPassword()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }

    }

    public function __construct($username = "", $password = "")
    {
        $this->setUsername($username);
        $this->setPassword($password);
    }

    public function __toString()
    {
        return json_encode(array(
            'user_id' => $this->getUserId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'user_created_at' => $this->getUserCreated()->format("d-m-Y H:i:s")
        ));
    }

}