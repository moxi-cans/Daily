<?php

declare(strict_types=1);

require_once "Chef.php";
require_once "Deliver.php";
require_once "Waiter.php";

class Facade
{
    protected Chef $chef;

    protected Waiter $waiter;

    protected Deliver $deliver;

    public function __construct()
    {
        $this->chef = new Chef();
        $this->waiter = new Waiter();
        $this->deliver = new Deliver();
    }

    public function order(string $food): void
    {
        $this->waiter->takeOrder($food);
        $this->chef->cook($food);
        $this->deliver->deliver($food);
    }

}