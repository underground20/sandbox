<?php

namespace App\Patterns\Decorator;

final readonly class Whip implements Beverage
{
    public function __construct(private Beverage $beverage)
    {
    }

    public function getDescription(): string
    {
        return $this->beverage->getDescription() . ' + whip';
    }

    public function cost(): float
    {
        return $this->beverage->cost() + 0.1;
    }

    public function size(): Size
    {
        return $this->beverage->size();
    }
}
