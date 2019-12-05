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

    public function loadById($id){
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM php7db.users WHERE user_id = :ID", array(
            ":ID"=>$id
        ));

        if (count($result) > 0){
            $row = $result[0];
            $this->setUserId($row['user_id']);
            $this->setUsername($row['username']);
            $this->setPassword($row['password']);
            $this->setUserCreated(new DateTime($row['user_created_at']));
        }
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