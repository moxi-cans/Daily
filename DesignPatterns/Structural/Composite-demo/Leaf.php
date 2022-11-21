<?php

declare(strict_types=1);

require_once 'Component.php';

class Leaf extends Component
{
    public function add(Component $c): void
    {
        echo "Cannot add to a leaf\n";
    }

    public function remove(Component $c): void
    {
        echo "Cannot remove from a leaf\n";
    }

    public function display($depth): void
    {
        echo str_repeat('-', $depth) . $this->name . "\n";
    }
}