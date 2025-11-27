<?php

namespace App\Patterns\Decorator;

final readonly class Espresso implements Beverage
{
    public function __construct(private Size $size = Size::Normal)
    {
    }

    public function getDescription(): string
    {
        return 'Espresso';
    }

    public function cost(): float
    {
        return 1.99;
    }

    public function size(): Size
    {
        return $this->size;
    }
}
