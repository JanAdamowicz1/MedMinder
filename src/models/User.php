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
    private $role = 'ROLE_USER';

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $this->extractUsernameFromEmail($email);
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
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }


    private function extractUsernameFromEmail(string $email): string
    {
    $parts = explode('@', $email);
    $username = $parts[0];

    return $username;
    }
}