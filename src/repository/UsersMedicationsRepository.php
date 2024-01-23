<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/UserMedication.php';
class UsersMedicationsRepository extends Repository
{
    public function addCustomMedication(UserMedication $userMedication): void
    {
        $userid = $_SESSION['userid'];

        $checkStmt = $this->database->connect()->prepare('
        SELECT usermedicationid FROM usermedications WHERE userid = ? AND medicationname = ? AND form = ? AND dose = ?
    ');
        $checkStmt->execute([$userid, $userMedication->getMedicationName(), $userMedication->getForm(), $userMedication->getDose()]);
        $existingEntry = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingEntry) {
            // Wpis już istnieje, zwracamy istniejące ID
            $userMedication->setId($existingEntry['usermedicationid']);
        } else {
            $insertStmt = $this->database->connect()->prepare('
            INSERT INTO usermedications (userid, medicationname, form, dose)
            VALUES (?, ?, ?, ?) RETURNING usermedicationid
        ');


            $insertStmt->execute([
                $userid,
                $userMedication->getMedicationName(),
                $userMedication->getForm(),
                $userMedication->getDose(),
            ]);

            $userMedicationId = $insertStmt->fetch(PDO::FETCH_ASSOC)['usermedicationid'];
            $userMedication->setId($userMedicationId);
        }
    }

    public function addMedication(UserMedication $userMedication): void
    {
        $userid = $_SESSION['userid'];

        $medicationName = $userMedication->getMedicationName();
        $medicationid = $this->getMedicationIdByName($medicationName);

        if ($medicationid === null) {
            throw new Exception("Medication not found.");
        }

        $checkStmt = $this->database->connect()->prepare('
        SELECT usermedicationid FROM usermedications WHERE userid = ? AND medicationid = ? AND medicationname = ? AND form = ? AND dose = ?
    ');
        $checkStmt->execute([$userid, $medicationid, $medicationName, $userMedication->getForm(), $userMedication->getDose()]);
        $existingEntry = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingEntry) {
            // Wpis już istnieje, zwracamy istniejące ID
            $userMedication->setId($existingEntry['usermedicationid']);
        } else {
            // Wpis nie istnieje, dodajemy nowy
            $insertStmt = $this->database->connect()->prepare('
            INSERT INTO usermedications (userid, medicationid, medicationname, form, dose)
            VALUES (?, ?, ?, ?, ?) RETURNING usermedicationid
        ');

            $insertStmt->execute([
                $userid,
                $medicationid,
                $medicationName,
                $userMedication->getForm(),
                $userMedication->getDose(),
            ]);

            $userMedicationId = $insertStmt->fetch(PDO::FETCH_ASSOC)['usermedicationid'];
            $userMedication->setId($userMedicationId);
        }
    }

    public function deleteMedication(int $scheduleid, int $usermedicationid): void
    {
        $stmt = $this->database->connect()->prepare('
        DELETE FROM medicationschedule WHERE scheduleid = :scheduleid AND usermedicationid = :usermedicationid
    ');
        $stmt->bindParam(':scheduleid', $scheduleid, PDO::PARAM_INT);
        $stmt->bindParam(':usermedicationid', $usermedicationid, PDO::PARAM_INT);
        $stmt->execute();

        //sprawdzenie czy z lekarstwem jest powiazany jeszcze jakis wpis
        $checkStmt = $this->database->connect()->prepare('
        SELECT COUNT(*) FROM medicationschedule WHERE usermedicationid = :usermedicationid
    ');
        $checkStmt->bindParam(':usermedicationid', $usermedicationid, PDO::PARAM_INT);
        $checkStmt->execute();

        $count = $checkStmt->fetchColumn();
        if ($count == 0) {
            // Jesli nie ma zadnych schedule zwiazanych z lekarstwem, usun lekarstwo
            $deleteStmt = $this->database->connect()->prepare('
            DELETE FROM usermedications WHERE usermedicationid = :usermedicationid
        ');
            $deleteStmt->bindParam(':usermedicationid', $usermedicationid, PDO::PARAM_INT);
            $deleteStmt->execute();
        }
    }

    public function getUsersMedications(): array
    {
        $userid = $_SESSION['userid'];

        $result = [];

        $stmt = $this->database->connect()->prepare('
        SELECT um.usermedicationid, um.userid, um.form, um.dose, um.medicationname, 
               ms.dayofweek, ms.timeofday, ms.dosesperintake, ms.scheduleid, ms.uploaddate
        FROM usermedications um
        JOIN medicationschedule ms ON um.usermedicationid = ms.usermedicationid
        WHERE um.userid = :userid
        ORDER BY um.medicationname;
    ');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();

        $medicationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($medicationsData === false) {
            throw new Exception("Can not receive users medications");
        }

        foreach ($medicationsData as $medication) {
            $userMedication = new UserMedication(
                $medication['medicationname'],
                $medication['form'],
                $medication['dose']
            );
            $userMedication->setId($medication['usermedicationid']);

            $medicationSchedule = new MedicationSchedule(
                $medication['scheduleid'],
                $medication['dosesperintake'],
                $medication['dayofweek'],
                $medication['timeofday'],
                $medication['uploaddate']
            );

            // Dodanie pary obiektów UserMedication i MedicationSchedule do wyniku
            $result[] = ['userMedication' => $userMedication, 'medicationSchedule' => $medicationSchedule];
        }

        return $result;
    }

    public function getMedicationByCurrentDay(string $currentDay)
    {
        $userid = $_SESSION['userid'];

        $stmt = $this->database->connect()->prepare('
        SELECT um.usermedicationid, um.userid, um.form, um.dose, um.medicationname, 
               ms.dayofweek, ms.timeofday, ms.dosesperintake
        FROM usermedications um
        JOIN medicationschedule ms ON um.usermedicationid = ms.usermedicationid
        WHERE ms.dayofweek = :dayofweek AND um.userid = :userid
        ORDER BY ms.timeofday;
    ');
        $stmt->bindParam(':dayofweek', $currentDay, PDO::PARAM_STR);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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