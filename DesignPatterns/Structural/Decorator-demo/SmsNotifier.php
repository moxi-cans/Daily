<?php

declare(strict_types=1);

require_once "NotifierDecorator.php";

class SmsNotifier extends NotifierDecorator
{
    public function send($message): void
    {
        $this->notifier->send($message);
        echo "Send sms: $message" . PHP_EOL;
    }
}