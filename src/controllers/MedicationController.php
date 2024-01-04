<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../repository/CategoryRepository.php';
require_once __DIR__.'/../models/Medication.php';
require_once __DIR__.'/../repository/MedicationRepository.php';
require_once __DIR__ .'/../models/UserMedication.php';
require_once __DIR__.'/../repository/UsersMedicationsRepository.php';

class MedicationController extends AppController {
    private $categoryRepository;
    private $medicationRepository;
    private $usersMedicationsRepository;
    private $message = [];

    public function __construct() {
        parent::__construct();
        $this->medicationRepository = new MedicationRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->usersMedicationsRepository = new UsersMedicationsRepository();
    }
    public function addMed() {
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
}