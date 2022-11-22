<?php

declare(strict_types=1);

require_once "NotifierDecorator.php";

class WechatNotifier extends NotifierDecorator
{
    public function send($message): void
    {
        $this->notifier->send($message);
        echo "Send wechat: $message" . PHP_EOL;
    }
}