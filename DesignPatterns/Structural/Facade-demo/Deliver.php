<?php

declare(strict_types=1);

class Deliver
{
    public function deliver(string $food): void
    {
        echo "服务员：好的，我去送{$food}。\n";
    }
}