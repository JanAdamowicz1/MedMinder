<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../repository/CategoryRepository.php';
require_once __DIR__.'/../models/Medication.php';
require_once __DIR__.'/../repository/MedicationRepository.php';
require_once __DIR__ .'/../models/MedicationCategory.php';
require_once __DIR__.'/../repository/MedicationCategoryRepository.php';

class MedicationController extends AppController {
    private $categoryRepository;
    private $medicationRepository;
    private $medicationCategoryRepository;
    private $message = [];

    public function __construct() {
        parent::__construct();
        $this->medicationRepository = new MedicationRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->medicationCategoryRepository = new MedicationCategoryRepository();
    }

    public function showMedsToCategory()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->medicationCategoryRepository->getMedicationsByCategory($decoded['search']));
        }
    }

    public function addMedToDatabase()
    {
        $categories = $this->categoryRepository->getCategories();
        if ($this->isPost())
        {
            $medicationName = $_POST['medicationName'];
            $categoryID = $_POST['category'];
            if($medicationName == ''){
                $this->message[] = 'Medication name cannot be empty';
                return $this->render('adminPanel', ['categories' => $categories, 'messages' => $this->message]);
            }

            $existingMedication = $this->medicationRepository->checkMedicationInCategory($categoryID, $medicationName);

            if ($existingMedication) {
                $this->message[] = 'Medication already exists in the category: ' . $existingMedication['categoryname'];
                return $this->render('adminPanel', ['categories' => $categories, 'messages' => $this->message]);
            }

            $medication = new Medication(0, $medicationName);
            $medicationID = $this->medicationRepository->addMedToDatabase($medication);

            $this->medicationCategoryRepository->associateMedicationWithCategory($medicationID, $categoryID);
            $this->message[] = 'Medication added successfully';
            return $this->render('adminPanel', ['categories' => $categories, 'messages' => $this->message]);
        }
        return $this->render('adminPanel', ['categories' => $categories]);
    }
}