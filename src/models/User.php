<?php

class User 
{
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    private $email;
    private $password;
    private $username;
    private $firstname;
    private $lastname;
    private $role;
    private $image;

    public function __construct(string $email, string $password, string $username, string $firstname, string $lastname, string $image, int $roleid)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->image = $image;
        if($roleid == 1){
            $this->role = self::ROLE_ADMIN;
        }
        else{
            $this->role = self::ROLE_USER;
        }
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setRole(string $role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }
    public function getLastname()
    {
        return $this->lastname;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

}