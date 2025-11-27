<?php

namespace App\Patterns\Decorator;

interface Beverage
{
    public function getDescription(): string;

    public function cost(): float;

    public function size(): Size;
}
