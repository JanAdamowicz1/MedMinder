<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Notification.php';

class NotificationRepository extends Repository
{
    public function addNotification(Notification $notification): void
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

        try
        {
            $stmt = $this->database->connect()->prepare('
            INSERT INTO notifications (userid, message, time, status, date, scheduleid)
            VALUES (?, ?, ?, ?, ?, ?)
        ');


            $stmt->execute([
                $userid,
                $notification->getMessage(),
                $notification->getTime(),
                $notification->isStatus() ? 'true' : 'false',
                $notification->getDate(),
                $notification->getScheduleId()
            ]);
        }
        catch (PDOException $e)
        {
            error_log($e->getMessage()); // Logowanie do pliku logów serwera
            echo "Błąd bazy danych: " . $e->getMessage();
        }
    }

    public function notificationExists($date, $time, $medicationScheduleId): bool
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM notifications WHERE date = ? AND time = ? AND scheduleid = ?
    ');
        $stmt->execute([$date, $time, $medicationScheduleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }


}