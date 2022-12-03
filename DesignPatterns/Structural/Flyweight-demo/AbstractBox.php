<?php

declare(strict_types=1);

abstract class AbstractBox
{
    abstract public function getShape(): string;

    public function display(string $color): void
    {
        echo "报告：方块形状为： {$this->getShape()}，颜色是： {$color}", PHP_EOL;
    }

}