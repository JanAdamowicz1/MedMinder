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

    public function addMedToDatabase(Medication $medication): int
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO medications (medicationname)
            VALUES (?) RETURNING medicationid
        ');

        $stmt->execute([
            $medication->getMedicationname()
        ]);

        $medicationId = $stmt->fetch(PDO::FETCH_ASSOC)['medicationid'];
        return $medicationId;
    }

}