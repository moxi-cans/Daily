<?php

declare(strict_types=1);

class LeaveRequest
{
    protected string $stuName;

    protected int $leaveDays;

    public function __construct(string $stuName, int $leaveDays) {
        $this->stuName = $stuName;
        $this->leaveDays = $leaveDays;
    }

    public function getStuName(): string
    {
        return $this->stuName;
    }

    public function getLeaveDays(): int
    {
        return $this->leaveDays;
    }

}