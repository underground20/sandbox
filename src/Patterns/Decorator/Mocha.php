<?php

namespace App\Patterns\Decorator;

final readonly class Mocha implements Beverage
{
    public function __construct(private Beverage $beverage)
    {
    }

    public function getDescription(): string
    {
        return $this->beverage->getDescription() . ' + mocha';
    }

    public function cost(): float
    {
        return $this->beverage->cost() + 0.2;
    }

    public function size(): Size
    {
        return $this->beverage->size();
    }
}
