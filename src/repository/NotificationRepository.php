<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Notification.php';

class NotificationRepository extends Repository
{
    public function addNotification(Notification $notification): void
    {
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

    public function getUsersNotifications(): array
    {
        $userRepository = new UserRepository();
        $email = $_SESSION['user'] ?? null;

        if (!$email) {
            throw new Exception("User is not logged in.");
        }

        $userid = $userRepository->getIdByEmail($email);
        if ($userid === null) {
            throw new Exception("User not found.");
        }

        try {
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM notifications WHERE userid = ? ORDER BY date DESC, time DESC
            ');
            $stmt->execute([$userid]);

            $notificationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $notifications = [];

            foreach ($notificationsData as $data) {
                $notification = new Notification(
                    $data['notificationid'],
                    $data['message'],
                    $data['time'],
                    $data['date'],
                    $data['status'],
                    $data['scheduleid']
                );
                $notifications[] = $notification;
            }
            return $notifications;
        } catch (PDOException $e) {
            throw new Exception();
        }
    }

    public function updateAllNotificationsStatus(): void
    {
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
        UPDATE notifications
        SET status = ?
        WHERE userid = ?
    ');

        $stmt->execute([
            'true',
            $userid
        ]);
    }

    public function getUserNotificationSetting()
    {
        $userRepository = new UserRepository();
        $email = $_SESSION['user'] ?? null;

        if (!$email) {
            throw new Exception("User is not logged in.");
        }

        $userid = $userRepository->getIdByEmail($email);
        if ($userid === null) {
            throw new Exception("User not found.");
        }

        $user = $userRepository->getUser($email);
        $userdetailsid = $userRepository->getUserDetailsId($user);

        $stmt = $this->database->connect()->prepare('
            SELECT notifications FROM userdetails WHERE userdetailsid = ?
        ');
        $stmt->execute([$userdetailsid]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['notifications'] == 'true')
        {
            return true;
        }
        return false;
    }

    public function updateNotifications($enable)
    {
        $userRepository = new UserRepository();
        $email = $_SESSION['user'] ?? null;

        if (!$email) {
            throw new Exception("User is not logged in.");
        }

        $userid = $userRepository->getIdByEmail($email);
        if ($userid === null) {
            throw new Exception("User not found.");
        }

        $user = $userRepository->getUser($email);
        $userdetailsid = $userRepository->getUserDetailsId($user);

        $stmt = $this->database->connect()->prepare('
        UPDATE userdetails
        SET notifications = :notifications
        WHERE userdetailsid = :userdetailsid
    ');

        $notifications = $enable ? 'true' : 'false';

        $stmt->bindParam(':notifications', $notifications, PDO::PARAM_STR);
        $stmt->bindParam(':userdetailsid', $userdetailsid, PDO::PARAM_INT);
        $stmt->execute();
    }
}