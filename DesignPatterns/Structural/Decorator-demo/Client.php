<?php

require_once "MailNotifier.php";
require_once "SmsNotifier.php";

$mailNotifier = new MailNotifier();
$smsNotifier = new SmsNotifier($mailNotifier);

$smsNotifier->send("Hello world");
