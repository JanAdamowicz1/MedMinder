<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UsersMedicationsRepository.php';
require_once __DIR__.'/../repository/NotificationRepository.php';
require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../repository/CategoryRepository.php';

class DefaultController extends AppController {
    private $usersMedicationsRepository;
    private $notificationRepository;
    private $notificationController;
    private $categoryRepository;
    public function __construct()
    {
        parent::__construct();
        $this->usersMedicationsRepository = new UsersMedicationsRepository();
        $this->notificationController = new NotificationController();
        $this->notificationRepository = new NotificationRepository();
        $this->categoryRepository = new CategoryRepository();
    }
    public function index(){
        $this->render('startPage');
    }

    public function signUp(){
        $this->render('signUp');
    }

    public function startPage(){
        $this->render('startPage');
    }

    public function logout(){
        $this->checkSession();
        $this->render('logout');
    }

    public function homePage()
    {
        $this->checkSession();
        $this->notificationController->generateNotifications();
        $this->notificationRepository->deleteOldNotificationsForUser();
        $usersMedications = $this->usersMedicationsRepository->getUsersMedications();
        $notifications = $this->notificationRepository->getUsersNotifications();
        $this->render('homePage', ['usersMedications' => $usersMedications, 'notifications' => $notifications]);
    }

    public function adminPanel()
    {
        $this->checkSession();
        $role = $_SESSION['role'];
        if($role == 'admin') {
            $categories = $this->categoryRepository->getCategories();
            return $this->render('adminPanel', ['categories' => $categories]);
        }
        else {
            throw new Exception('User is not an admin.');
        }
    }

}

?>