<?php

declare(strict_types=1);

require_once "NotifierInterface.php";

class MailNotifier implements NotifierInterface
{
    public function send($message): void
    {
        echo "Send mail: $message" . PHP_EOL;
    }
}