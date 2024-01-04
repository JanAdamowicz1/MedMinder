<?php

class Medication {
    private $medicationid;
    private $medicationname;

    public function __construct($medicationid, $medicationname)
    {
        $this->medicationid = $medicationid;
        $this->medicationname = $medicationname;
    }

    public function getMedicationid()
    {
        return $this->medicationid;
    }

    public function setMedicationid($medicationid): void
    {
        $this->medicationid = $medicationid;
    }

    public function getMedicationname()
    {
        return $this->medicationname;
    }

    public function setMedicationname($medicationname): void
    {
        $this->medicationname = $medicationname;
    }

}