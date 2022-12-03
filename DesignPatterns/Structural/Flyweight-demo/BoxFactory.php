<?php

declare(strict_types=1);

require_once "SquareBox.php";
require_once "CircleBox.php";
require_once "TriangleBox.php";

class BoxFactory
{
    private static BoxFactory $instance;

    private array $boxes = [];

    public function getBox(string $shape): AbstractBox
    {
        if (!isset($this->boxes[$shape])) {
            $this->boxes[$shape] = match ($shape) {
                'square' => new SquareBox(),
                'circle' => new CircleBox(),
                'triangle' => new TriangleBox(),
                default => throw new \InvalidArgumentException('Invalid shape'),
            };
        }

        return $this->boxes[$shape];
    }

    public static function getInstance(): BoxFactory
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}