<?php

declare(strict_types=1);

require_once 'LeaveRequest.php';

interface ILeaveRequestHandler
{
    public function handleRequest(LeaveRequest $request);
}