<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/UserMedication.php';
class UsersMedicationsRepository extends Repository
{
    public function getUserMedication(int $usermedicationid): ?UserMedication
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.usermedications WHERE usermedicationid = :usermedicationid
        ');
        $stmt->bindParam(':usermedicationid', $usermedicationid, PDO::PARAM_INT);
        $stmt->execute();

        $usermedication = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usermedication == false) {
            throw new Exception("User medication with ID $usermedicationid not found.");
        }

        return new UserMedication(
            $usermedication['medicationname'],
            $usermedication['form'],
            $usermedication['dose']
        );
    }

    public function addCustomMedication(UserMedication $userMedication): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userRepository = new UserRepository();
        $email = $_SESSION['user'] ?? null;

        if (!$email) {
            throw new Exception("User is not logged in.");
        }

        $userid = $userRepository->getIdByEmail($email);
        if ($userid === null) {
            throw new Exception("User not found.");
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO usermedications (userid, medicationname, form, dose)
            VALUES (?, ?, ?, ?) RETURNING usermedicationid
        ');

        $stmt->execute([
            $userid,
            $userMedication->getMedicationName(),
            $userMedication->getForm(),
            $userMedication->getDose(),
        ]);

        $userMedicationId = $stmt->fetch(PDO::FETCH_ASSOC)['usermedicationid'];
        $userMedication->setId($userMedicationId);
    }

    public function addMedication(UserMedication $userMedication): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userRepository = new UserRepository();
        $email = $_SESSION['user'] ?? null;

        if (!$email) {
            throw new Exception("User is not logged in.");
        }

        $userid = $userRepository->getIdByEmail($email);
        if ($userid === null) {
            throw new Exception("User not found.");
        }

        $medicationName = $userMedication->getMedicationName();
        $medicationid = $this->getMedicationIdByName($medicationName);

        if ($medicationid === null) {
            throw new Exception("Medication not found.");
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO usermedications (userid, medicationid, medicationname, form, dose)
            VALUES (?, ?, ?, ?, ?) RETURNING usermedicationid
        ');

        $stmt->execute([
            $userid,
            $medicationid,
            $medicationName,
            $userMedication->getForm(),
            $userMedication->getDose(),
        ]);

        $userMedicationId = $stmt->fetch(PDO::FETCH_ASSOC)['usermedicationid'];
        $userMedication->setId($userMedicationId);
    }


    public function getUsersMedications(): array
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userRepository = new UserRepository();
        $email = $_SESSION['user'] ?? null;

        $userid = $userRepository->getIdByEmail($email);
        if ($userid === null) {
            throw new Exception("User not found.");
        }

        $result = [];

        $stmt = $this->database->connect()->prepare('
        SELECT * FROM usermedications WHERE userid = :userid;
        ');

        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
        $usersMedications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usersMedications as $usersMedication) {
            $result[] = new UserMedication(
                $usersMedication['medicationname'],
                $usersMedication['form'],
                $usersMedication['dose']
            );
        }

        return $result;
    }

    private function getMedicationIdByName(string $medicationName)
    {
        $stmt = $this->database->connect()->prepare('
        SELECT medicationid FROM medications WHERE medicationname = :medicationname
    ');

        $stmt->bindParam(':medicationname', $medicationName, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['medicationid'] : null;
    }
}