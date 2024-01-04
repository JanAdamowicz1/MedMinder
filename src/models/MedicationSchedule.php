<?php

class MedicationSchedule
{
    private $id;
    private $dosesPerIntake;
    private $dayOfWeek;
    private $timeOfDay;

    public function __construct($id, $dosesPerIntake, $dayOfWeek, $timeOfDay)
    {
        $this->id = $id;
        $this->dosesPerIntake = $dosesPerIntake;
        $this->dayOfWeek = $dayOfWeek;
        $this->timeOfDay = $timeOfDay;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getDosesPerIntake()
    {
        return $this->dosesPerIntake;
    }

    public function setDosesPerIntake($dosesPerIntake): void
    {
        $this->dosesPerIntake = $dosesPerIntake;
    }

    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek($dayOfWeek): void
    {
        $this->dayOfWeek = $dayOfWeek;
    }

    public function getTimeOfDay()
    {
        return $this->timeOfDay;
    }

    public function setTimeOfDay($timeOfDay): void
    {
        $this->timeOfDay = $timeOfDay;
    }

}