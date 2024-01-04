<?php

class MedicationCategory
{
    private $medicationcategoriesid;
    private $medicationid;
    private $categoryid;

    public function __construct($medicationcategoriesid, $medicationid, $categoryid)
    {
        $this->medicationcategoriesid = $medicationcategoriesid;
        $this->medicationid = $medicationid;
        $this->categoryid = $categoryid;
    }

    public function getMedicationcategoriesid()
    {
        return $this->medicationcategoriesid;
    }

    public function setMedicationcategoriesid($medicationcategoriesid): void
    {
        $this->medicationcategoriesid = $medicationcategoriesid;
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