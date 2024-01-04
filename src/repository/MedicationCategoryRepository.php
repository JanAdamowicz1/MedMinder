<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/MedicationCategory.php';
class MedicationCategoryRepository extends Repository {
    public function getMedicationsByCategory($categoryId) {
        $stmt = $this->database->connect()->prepare('
            SELECT m.medicationid, m.medicationname
            FROM medications m
            INNER JOIN medicationscategories mc ON m.medicationid = mc.medicationid
            WHERE mc.categoryid = :categoryid
        ');
        $stmt->bindParam(':categoryid', $categoryId, PDO::PARAM_INT);
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