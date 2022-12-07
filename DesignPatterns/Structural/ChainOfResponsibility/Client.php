<?php

require_once "Dean.php";
require_once "DepartmentHead.php";
require_once "ClassAdviser.php";
require_once "LeaveRequest.php";

$dean = new Dean();
$departmentHead = new DepartmentHead($dean);
$classAdviser = new ClassAdviser($departmentHead);

$request = new LeaveRequest('小明', 2);
$classAdviser->handleRequest($request);

$request = new LeaveRequest('小红', 5);
$classAdviser->handleRequest($request);

$request = new LeaveRequest('小李', 11);
$classAdviser->handleRequest($request);