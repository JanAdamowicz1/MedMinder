<?php

class MedicationCategory
{
    private $medicationid;
    private $categoryid;

    public function __construct(int $medicationid, int $categoryid)
    {
        $this->medicationid = $medicationid;
        $this->categoryid = $categoryid;
    }

    public function getMedicationid()
    {
        return $this->medicationid;
    }

    public function setMedicationid($medicationid): void
    {
        $this->medicationid = $medicationid;
    }

    public function getCategoryid()
    {
        return $this->categoryid;
    }

    public function setCategoryid($categoryid): void
    {
        $this->categoryid = $categoryid;
    }

}