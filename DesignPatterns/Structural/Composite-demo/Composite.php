<?php

declare(strict_types=1);

require_once 'Component.php';

class Composite extends Component
{
    private array $children  = [];

    public function add(Component $component): void
    {
        $this->children[] = $component;
    }

    public function remove(Component $component): void
    {
        $this->children = array_filter($this->children, function ($c) use ($component) {
            return $c !== $component;
        });
    }

    public function display($depth): void
    {
        echo str_repeat('-', $depth) . $this->name . "\n";
        foreach ($this->children as $child) {
            $child->display($depth + 2);
        }
    }
}