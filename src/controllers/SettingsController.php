<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Notification.php';
require_once __DIR__.'/../repository/NotificationRepository.php';

class SettingsController extends AppController {
    private $notificationRepository;
    public function __construct()
    {
        parent::__construct();
        $this->notificationRepository = new NotificationRepository();
    }

    public function settings()
    {
        $this->checkSession();
        $enableNotifications = $this->notificationRepository->getUserNotificationSetting();
        return $this->render('settings', ['userNotificationsEnabled' => $enableNotifications]);
    }

    public function changeNotificationSetting()
    {
        $this->checkSession();
        $enableNotifications = $this->notificationRepository->getUserNotificationSetting();
        if ($this->isPost()) {
            $enableNotifications = isset($_POST['notifications']) && $_POST['notifications'] === 'on';
            $this->notificationRepository->updateNotifications($enableNotifications);
            return $this->render('settings', ['userNotificationsEnabled' => $enableNotifications]);
        }
        return $this->render('settings', ['userNotificationsEnabled' => $enableNotifications]);
    }
}

?>