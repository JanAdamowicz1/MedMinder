<?php

class UserMedication
{
    private $medicationName;
    private $form;
    private $dose;
    private $isCustom;
    private $id;

    public function __construct(string $medicationName, string $form, int $dose)
    {
        $this->medicationName = $medicationName;
        $this->form = $form;
        $this->dose = $dose;
    }

    public function getMedicationName(): string
    {
        return $this->medicationName;
    }

    public function setMedicationName(string $medicationName): void
    {
        $this->medicationName = $medicationName;
    }

    public function getForm(): string
    {
        return $this->form;
    }

    public function setForm(string $form): void
    {
        $this->form = $form;
    }

    public function getDose(): int
    {
        return $this->dose;
    }

    public function setDose(int $dose): void
    {
        $this->dose = $dose;
    }


    public function isCustom(): bool
    {
        return $this->isCustom;
    }

    public function setIsCustom(bool $isCustom): void
    {
        $this->isCustom = $isCustom;
    }

    public function setId($userMedicationId)
    {
        $this->id = $userMedicationId;
    }

    public function getId()
    {
        return $this->id;
    }

}