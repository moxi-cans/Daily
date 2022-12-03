<?php

declare(strict_types=1);

require_once "AbstractBox.php";

class SquareBox extends AbstractBox
{
    public function getShape(): string
    {
        return 'square';
    }
}