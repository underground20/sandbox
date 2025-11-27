<?php

namespace App\Patterns\Decorator;

final readonly class Soy implements Beverage
{
    public function __construct(private Beverage $beverage)
    {
    }

    public function getDescription(): string
    {
        return $this->beverage->getDescription() . ' + soy';
    }

    public function cost(): float
    {
        $additionCost = match ($this->beverage->size()) {
            Size::Small => 0.1,
            Size::Normal => 0.15,
            Size::Big => 0.2,
        };

        return $this->beverage->cost() + $additionCost;
    }

    public function size(): Size
    {
        return $this->beverage->size();
    }


}
