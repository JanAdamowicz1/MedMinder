<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/UserMedication.php';
require_once __DIR__.'/../repository/UsersMedicationsRepository.php';
require_once __DIR__ .'/../models/MedicationSchedule.php';
require_once __DIR__.'/../repository/MedicationScheduleRepository.php';
class UsersMedicationsController extends AppController
{
    private $usersMedicationsRepository;
    private $medicationScheduleRepository;
    private $message = [];

    public function __construct()
    {
        parent::__construct();
        $this->usersMedicationsRepository = new UsersMedicationsRepository();
        $this->medicationScheduleRepository = new MedicationScheduleRepository();
    }

    public function homePage()
    {
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


    public function dosageSchedule()
    {
        if ($this->isPost())
        {
            $medicationSchedule = new MedicationSchedule($_POST['medicationId'], $_POST['dosesperintake'], $_POST['day'], $_POST['intake_time']);
            $this->medicationScheduleRepository->addDosageSchedule($medicationSchedule);
            return $this->render('homePage',
                ['usersMedications' => $this->usersMedicationsRepository->getUsersMedications(),
                    'messages' => $this->message]);
        }
        return $this->render('homePage', ['messages' => $this->message]);
    }
}