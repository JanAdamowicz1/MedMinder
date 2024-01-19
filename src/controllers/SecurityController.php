<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login()
    {
        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if($user->getEmail() !== $email){
            return $this->render('login', ['messages' => ['User with this email does not exist']]);
        }

        $hashedPassword = $user->getPassword();

        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['user'] = htmlspecialchars($_POST['email']);
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['image'] = $user->getImage();
            $_SESSION['role'] = $user->getRole();
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/homePage");
        }
        else {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }
    }

    public function signUp()
    {
        if (!$this->isPost()) {
            return $this->render('signUp');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmedPassword = $_POST["confirmedPassword"];
        
        if ($password !== $confirmedPassword) {
            return $this->render('signUp', ['messages' => ['Confirmed password and password must be the same']]);
        }

        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $email, '', '', '', $this->userRepository->getRoleId('user'));

        if(!$this->userRepository->userExists($user)) {
            $this->userRepository->addUser($user);
            return $this->render('login', ['messages' => ['You\'ve been succesfully signed up!']]);
        }
        return $this->render('signUp', ['messages' => ['User with this email already exists']]);
    }
}