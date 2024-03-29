<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/MedicationSchedule.php';
class MedicationScheduleRepository extends Repository
{
    public function addDosageSchedule(MedicationSchedule $medicationSchedule): void
    {
        try
        {
            $stmt = $this->database->connect()->prepare('
            INSERT INTO medicationschedule (usermedicationid, dayofweek, timeofday, dosesperintake, uploaddate)
            VALUES (?, ?, ?, ?, ?)
        ');

            $stmt->execute([
                $medicationSchedule->getId(),
                $medicationSchedule->getDayOfWeek(),
                $medicationSchedule->getTimeOfDay(),
                $medicationSchedule->getDosesPerIntake(),
                $medicationSchedule->getUploadDate()
            ]);
        }
        catch (PDOException $e)
        {
            throw new Exception("Can not add data to dosage schedule");
        }
    }

    public function updateUploadDate(int $medicationScheduleId, string $newUploadDate): void
    {
        $stmt = $this->database->connect()->prepare('
        UPDATE medicationschedule SET uploaddate = ? WHERE scheduleid = ?
    ');
        $stmt->execute([$newUploadDate, $medicationScheduleId]);
    }
}