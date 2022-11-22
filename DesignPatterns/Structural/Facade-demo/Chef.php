<?php

declare(strict_types=1);

class Chef
{
    public function cook(string $food): void
    {
        echo "厨师：好的，我去做{$food}。\n";
    }
}