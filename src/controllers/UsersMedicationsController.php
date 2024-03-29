<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/UserMedication.php';
require_once __DIR__.'/../repository/UsersMedicationsRepository.php';
require_once __DIR__ .'/../models/Medication.php';
require_once __DIR__.'/../repository/MedicationRepository.php';
require_once __DIR__ .'/../models/Category.php';
require_once __DIR__.'/../repository/CategoryRepository.php';
class UsersMedicationsController extends AppController
{
    private $usersMedicationsRepository;
    private $medicationRepository;
    private $categoryRepository;
    private $message = [];
    public function __construct()
    {
        parent::__construct();
        $this->usersMedicationsRepository = new UsersMedicationsRepository();
        $this->medicationRepository = new MedicationRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function yourMedications()
    {
        $this->checkSession();
        $this->render('yourMedications', ['usersMedications' => $this->usersMedicationsRepository->getUsersMedications()]);
    }

    public function addCustomMed()
    {
        $this->checkSession();
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

    public function addMed() {
        $this->checkSession();
        $categories = $this->categoryRepository->getCategories();
        $medications = $this->medicationRepository->getMedications();

        if ($this->isPost()) {
            $userMedication = new UserMedication($_POST['medicationName'], $_POST['form'], $_POST['dose']);
            $this->usersMedicationsRepository->addMedication($userMedication);

            return $this->render('dosageSchedule', [
                'userMedication' => $userMedication,
                'messages' => $this->message
            ]);
        } else {
            return $this->render('addMed', [
                'categories' => $categories,
                'medications' => $medications
            ]);
        }
    }

    public function deleteMedication()
    {
        $this->checkSession();
        if ($this->isPost()) {
            $scheduleid = $_POST['scheduleid'] ?? null;
            $usermedicationid = $_POST['usermedicationid'] ?? null;
            if ($scheduleid && $usermedicationid) {
                $this->usersMedicationsRepository->deleteMedication($scheduleid, $usermedicationid);
            }
            return $this->render('yourMedications', ['usersMedications' => $this->usersMedicationsRepository->getUsersMedications()]);
        }
    }

    public function showUsersMedicationsToCurrentDay()
    {
        $this->checkSession();
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