<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/MedicationCategory.php';
class MedicationCategoryRepository extends Repository {
    public function getMedicationsByCategory(string $category)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT m.medicationname
            FROM medications m
            JOIN medicationcategories mc ON m.medicationid = mc.medicationid
            JOIN categories c ON mc.categoryid = c.categoryid
            WHERE c.categoryname = :category;
        ');
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function associateMedicationWithCategory(MedicationCategory $medicationCategory): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO medicationcategories (medicationid, categoryid)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $medicationCategory->getMedicationid(),
            $medicationCategory->getCategoryid()
        ]);
    }
}