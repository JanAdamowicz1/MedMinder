<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/MedicationSchedule.php';
require_once __DIR__.'/../repository/MedicationScheduleRepository.php';

class MedicationScheduleController extends AppController {
    private $medicationScheduleRepository;
    public function __construct()
    {
        parent::__construct();
        $this->medicationScheduleRepository = new MedicationScheduleRepository();
    }

    public function dosageSchedule()
    {
        $this->checkSession();
        if ($this->isPost())
        {
            $medicationSchedule = new MedicationSchedule($_POST['medicationId'], $_POST['dosesperintake'], $_POST['day'], $_POST['intake_time'], date('Y-m-d'));
            $this->medicationScheduleRepository->addDosageSchedule($medicationSchedule);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/homePage");
        }
    }
}

?>