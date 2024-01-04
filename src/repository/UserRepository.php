<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
            //dorobic exception (filmik 8 minuta 28)
        }

        return new User(
            $user['email'],
            $user['password']
        );
    }

    public function getIdByEmail(string $email): ?int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT userid FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            return null;
        }

        return (int) $result['userid'];
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO userdetails (username)
            VALUES (?)
        ');

        $stmt->execute([
            $user->getUsername()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, userdetailsid, roleid)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $this->getRoleId('user')
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.userdetails WHERE username = :username
        ');
        $username = $user->getUsername();
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['userdetailsid'];
    }

    public function getRoleId($roleName): int
    {
        // Prepare the SQL statement with a placeholder for the role name
        $stmt = $this->database->connect()->prepare('
        SELECT roleid FROM public.roles WHERE rolename = :rolename
    ');

        $stmt->bindParam(':rolename', $roleName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['roleid'] : 0;
    }
}