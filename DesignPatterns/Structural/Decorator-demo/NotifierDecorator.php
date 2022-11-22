<?php

declare(strict_types=1);

abstract class NotifierDecorator
{
    protected NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }
}