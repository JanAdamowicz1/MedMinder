<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/MedicationSchedule.php';
class MedicationScheduleRepository extends Repository
{
    public function addDosageSchedule(MedicationSchedule $medicationSchedule)
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

        }
    }

    public function updateUploadDate($medicationScheduleId, $newUploadDate)
    {
        $stmt = $this->database->connect()->prepare('
        UPDATE medicationschedule SET uploaddate = ? WHERE scheduleid = ?
    ');
        $stmt->execute([$newUploadDate, $medicationScheduleId]);
    }
}