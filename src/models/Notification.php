<?php

class Notification
{
    private $id;
    private $message;
    private $time;
    private $date;
    private $status;
    private $scheduleid;

    public function __construct(int $id, string $message, string $time, string $date, bool $status, int $scheduleid)
    {
        $this->id = $id;
        $this->message = $message;
        $this->time = $time;
        $this->date = $date;
        $this->status = $status;
        $this->scheduleid = $scheduleid;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function getScheduleId(): int
    {
        return $this->scheduleid;
    }


}