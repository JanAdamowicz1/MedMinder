<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/MedicationSchedule.php';
class MedicationScheduleRepository extends Repository
{
    public function addDosageSchedule(MedicationSchedule $medicationSchedule)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO medicationschedule (usermedicationid, dayofweek, timeofday, dosesperintake)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $medicationSchedule->getId(),
            $medicationSchedule->getDayOfWeek(),
            $medicationSchedule->getTimeOfDay(),
            $medicationSchedule->getDosesPerIntake()
        ]);
    }
}