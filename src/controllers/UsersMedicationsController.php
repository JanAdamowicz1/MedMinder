<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/UserMedication.php';
require_once __DIR__.'/../repository/UsersMedicationsRepository.php';
require_once __DIR__ .'/../models/MedicationSchedule.php';
require_once __DIR__.'/../repository/MedicationScheduleRepository.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../controllers/NotificationController.php';
class UsersMedicationsController extends AppController
{
    private $usersMedicationsRepository;
    private $medicationScheduleRepository;
    private $notificationController;
    private $message = [];
    public function __construct()
    {
        parent::__construct();
        $this->usersMedicationsRepository = new UsersMedicationsRepository();
        $this->medicationScheduleRepository = new MedicationScheduleRepository();
        $this->notificationController = new NotificationController();
    }

    public function yourMedications()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->render('yourMedications', ['usersMedications' => $this->usersMedicationsRepository->getUsersMedications()]);
    }

    public function homePage()
    {
        $this->notificationController->generateNotifications();
        $usersMedications = $this->usersMedicationsRepository->getUsersMedications();
        $this->render('homePage', ['usersMedications' => $usersMedications]);
    }

    public function addCustomMed()
    {
        if ($this->isPost())
        {
            $userMedication = new UserMedication($_POST['medicationName'], $_POST['form'], $_POST['dose']);
            $this->usersMedicationsRepository->addCustomMedication($userMedication);
            return $this->render('dosageSchedule',
                ['userMedication' => $userMedication,
                    'messages' => $this->message]);
        }
        return $this->render('addCustomMed', ['messages' => $this->message]);
    }

    public function deleteMedication()
    {
        if ($this->isPost()) {
            $scheduleid = $_POST['scheduleid'] ?? null;
            $usermedicationid = $_POST['usermedicationid'] ?? null;
            if ($scheduleid && $usermedicationid) {
                $this->usersMedicationsRepository->deleteMedication($scheduleid, $usermedicationid);
            }
            return $this->render('yourMedications', ['usersMedications' => $this->usersMedicationsRepository->getUsersMedications()]);
        }
    }

    public function dosageSchedule()
    {
        if ($this->isPost())
        {
            $medicationSchedule = new MedicationSchedule($_POST['medicationId'], $_POST['dosesperintake'], $_POST['day'], $_POST['intake_time'], date('Y-m-d'));
            $this->medicationScheduleRepository->addDosageSchedule($medicationSchedule);
            return $this->render('homePage',
                ['usersMedications' => $this->usersMedicationsRepository->getUsersMedications(),
                    'messages' => $this->message]);
        }
        return $this->render('homePage', ['messages' => $this->message]);
    }

    public function showUsersMedicationsToCurrentDay()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->usersMedicationsRepository->getMedicationByCurrentDay($decoded['dayOfWeek']));
        }
    }
}