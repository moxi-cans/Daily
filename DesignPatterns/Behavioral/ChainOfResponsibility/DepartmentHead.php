<?php

declare(strict_types=1);

require_once "ILeaveRequestHandler.php";
require_once "LeaveRequest.php";

class DepartmentHead implements ILeaveRequestHandler
{
    protected ILeaveRequestHandler $successor;

    public function __construct(ILeaveRequestHandler $successor)
    {
        $this->successor = $successor;
    }

    public function handleRequest(LeaveRequest $request)
    {
        if ($request->getLeaveDays() < 3) {
            echo "班主任批准了{$request->getStuName()}的请假请求。", PHP_EOL;
        } else {
            $this->successor->handleRequest($request);
        }
    }
}