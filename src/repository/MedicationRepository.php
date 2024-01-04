<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Medication.php';
class MedicationRepository extends Repository {
    public function getMedications() {
        $stmt = $this->database->connect()->prepare('
            SELECT medicationid, medicationname FROM medications
        ');
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $medications = [];

        foreach ($result as $row) {
            $medication = new Medication($row['medicationid'], $row['medicationname']);
            array_push($medications, $medication);
        }

        return $medications;
    }
}