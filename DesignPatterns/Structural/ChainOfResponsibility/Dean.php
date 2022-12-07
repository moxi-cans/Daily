<?php

declare(strict_types=1);

require_once "ILeaveRequestHandler.php";
require_once "LeaveRequest.php";

class Dean implements ILeaveRequestHandler
{
    public function handleRequest(LeaveRequest $request)
    {
        if ($request->getLeaveDays() < 10) {
            echo "院长批准了{$request->getStuName()}的请假请求。", PHP_EOL;
        } else {
            echo "太长的假，不批。", PHP_EOL;
        }
    }
}