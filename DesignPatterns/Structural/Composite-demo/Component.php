<?php

declare(strict_types=1);

abstract class Component
{
    protected string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function add(Component $c);

    abstract public function remove(Component $c);

    abstract public function display($depth);

}