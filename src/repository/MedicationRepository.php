<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Medication.php';
class MedicationRepository extends Repository {
    public function getMedications(): array
    {
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
        $medicationName = $medication->getMedicationname();

        // Sprawdź, czy lek już istnieje w bazie danych
        $existingMedicationID = $this->getMedicationIDByName($medicationName);

        if ($existingMedicationID) {
            // Jeśli lek już istnieje, zwróć jego istniejący identyfikator
            return $existingMedicationID;
        } else {
            // Jeśli lek nie istnieje, dodaj go do bazy danych
            $stmt = $this->database->connect()->prepare('
            INSERT INTO medications (medicationname)
            VALUES (?) RETURNING medicationid
        ');

            $stmt->execute([$medicationName]);

            $medicationId = $stmt->fetch(PDO::FETCH_ASSOC)['medicationid'];
            return $medicationId;
        }
    }
    public function checkMedicationInCategory(int $categoryId, string $medicationName)
    {
        //zapytanie do widoku CategoriesAndMedications
        $stmt = $this->database->connect()->prepare('
        SELECT categoryname, medicationname
        FROM CategoriesAndMedications
        WHERE categoryid = ? AND medicationname = ?
    ');

        $stmt->execute([$categoryId, $medicationName]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function getMedicationIDByName(string $medicationName): ?int
    {
        $stmt = $this->database->connect()->prepare('
        SELECT medicationid
        FROM medications
        WHERE medicationname = ?
    ');

        $stmt->execute([$medicationName]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? (int)$result['medicationid'] : null;
    }

}