<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT u.email, u.password, ud.firstname, ud.lastname, ud.username, ud.photo
        FROM public.users u
        LEFT JOIN public.userdetails ud ON u.userdetailsid = ud.userdetailsid
        WHERE u.email = :email
    ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData == false) {
            return null;
            //dorobic exception (filmik 8 minuta 28)
        }

        return new User(
            $userData['email'],
            $userData['password'],
            $userData['username'],
            $userData['firstname'] ?? '',
            $userData['lastname'] ?? '',
            $userData['photo']
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

    public function updateUserImage($user)
    {
        $userdetailsid = $this->getUserDetailsId($user);
        $stmt = $this->database->connect()->prepare('
        UPDATE userdetails
        SET photo = ?
        WHERE userdetailsid = ?
    ');

        $stmt->execute([
            $user->getImage(),
            $userdetailsid
        ]);
    }

    public function updateUsername($user, $newUsername)
    {
        $userdetailsid = $this->getUserDetailsId($user);
        $user->setUsername($newUsername);
        $_SESSION['username'] = $user->getUsername();
        $stmt = $this->database->connect()->prepare('
        UPDATE userdetails
        SET username = ?
        WHERE userdetailsid = ?
    ');

        $stmt->execute([
            $user->getUsername(),
            $userdetailsid
        ]);
    }

    public function updateName($user)
    {
        $userdetailsid = $this->getUserDetailsId($user);

        $stmt = $this->database->connect()->prepare('
        UPDATE userdetails
        SET firstname = ?, lastname = ?
        WHERE userdetailsid = ?
    ');

        $stmt->execute([
            $user->getFirstname(),
            $user->getLastname(),
            $userdetailsid
        ]);
    }
}