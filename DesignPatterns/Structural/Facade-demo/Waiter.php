<?php

declare(strict_types=1);

class Waiter
{
    public function takeOrder(string $food): void
    {
        echo "服务员：好的，我去告诉厨师您要{$food}。\n";
    }
}