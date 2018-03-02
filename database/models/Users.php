<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return Users
     */
    public function setMail(string $mail): Users
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $username
     * @return Users
     */
    public function setUsername(string $username): Users
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Users
     */
    public function setPassword(string $password): Users
    {
        $this->password = $password;
        return $this;
    }
}
