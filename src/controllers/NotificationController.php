<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Notification.php';
require_once __DIR__.'/../repository/NotificationRepository.php';
require_once __DIR__ .'/../models/UserMedication.php';
require_once __DIR__.'/../repository/UsersMedicationsRepository.php';
require_once __DIR__ .'/../models/MedicationSchedule.php';
require_once __DIR__.'/../repository/MedicationScheduleRepository.php';


class NotificationController extends AppController
{
    private $notificationRepository;
    private $usersMedicationsRepository;
    private $medicationScheduleRepository;
    public function __construct()
    {
        parent::__construct();
        $this->notificationRepository = new NotificationRepository();
        $this->usersMedicationsRepository = new UsersMedicationsRepository();
        $this->medicationScheduleRepository = new MedicationScheduleRepository();
    }

    public function generateNotifications()
    {
        $this->checkSession();
        date_default_timezone_set('Europe/Warsaw');
        $usersMedicationsWithSchedule = $this->usersMedicationsRepository->getUsersMedications();

        foreach ($usersMedicationsWithSchedule as $medicationWithSchedule) {
            $userMedication = $medicationWithSchedule['userMedication'];
            $medicationSchedule = $medicationWithSchedule['medicationSchedule'];

            $uploadDate = new DateTime($medicationSchedule->getUploadDate());
            $today = new DateTime();


            while ($uploadDate <= $today) {
                // Sprawdzenie, czy dzień tygodnia odpowiada dniowi przyjmowania leku
                if (strtolower($uploadDate->format('l')) === strtolower($medicationSchedule->getDayOfWeek())) {
                    $date = $uploadDate->format('Y-m-d');
                    $todayDate = $today->format('Y-m-d');
                    $time = new DateTime($medicationSchedule->getTimeOfDay());
                    $currentTime = new DateTime();

                    if ($date == $todayDate && $currentTime->format('H:i') < $time->format('H:i')) {
                        // Jeśli jest dzisiaj, ale aktualna godzina jest wcześniej niż czas w harmonogramie, pomiń tworzenie powiadomienia
                        break;
                    }

                    $message = "It's " . $time->format('H:i') . "! Take " . $userMedication->getMedicationName();

                    // Sprawdzenie, czy powiadomienie już istnieje i czy użytkownik ma włączone powiadomienia
                    if (!($this->notificationRepository->notificationExists($date, $time->format('H:i'), $medicationSchedule->getId())) && $this->notificationRepository->getUserNotificationSetting()) {
                        $notification = new Notification(0, $message, $time->format('H:i'), $date, false, $medicationSchedule->getId());
                        $this->notificationRepository->addNotification($notification);
                    }
                }
                $uploadDate->modify('+1 day');
            }
            $this->medicationScheduleRepository->updateUploadDate($medicationSchedule->getId(), $today->format('Y-m-d'));
        }
    }
    public function setAllAsRead() {
        $this->checkSession();
        if ($this->isPost()) {
            $this->notificationRepository->updateAllNotificationsStatus();
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/homePage");
        }
    }
}
