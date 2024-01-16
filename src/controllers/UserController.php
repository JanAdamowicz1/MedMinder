<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class UserController extends AppController
{
    private $userRepository;
    private $message = [];
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function account()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user = $this->userRepository->getUser($_SESSION['user']);
        $this->render('account', ['user' => $user, 'messages' => $this->message]);
    }

    public function changePhoto()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user = $this->userRepository->getUser($_SESSION['user']);

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $user->setImage($_FILES['file']['name']);
            $_SESSION['image'] = $user->getImage();
            $this->userRepository->updateUserImage($user);

            return $this->render('account', ['user' => $user, 'messages' => $this->message]);
        }
        return $this->render('account', ['user' => $user, 'messages' => $this->message]);
    }

    public function changeUsername()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user = $this->userRepository->getUser($_SESSION['user']);

        if ($this->isPost())
        {
            $newUsername = $_POST['username'];

            //TODO dorobic sprawdzenie czy username juz istnieje

            $this->userRepository->updateUsername($user, $newUsername);
            return $this->render('account', ['user' => $user, 'messages' => $this->message]);
        }
        return $this->render('account', ['user' => $user, 'messages' => $this->message]);
    }

    public function changeName()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user = $this->userRepository->getUser($_SESSION['user']);

        if ($this->isPost())
        {
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $this->userRepository->updateName($user);
            return $this->render('account', ['user' => $user, 'messages' => $this->message]);
        }
        return $this->render('account', ['user' => $user, 'messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}