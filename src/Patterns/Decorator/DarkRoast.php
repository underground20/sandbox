<?php

namespace App\Patterns\Decorator;

final readonly class DarkRoast implements Beverage
{
    public function __construct(private Size $size = Size::Normal)
    {
    }

    public function getDescription(): string
    {
        return 'Dark roast';
    }

    public function cost(): float
    {
        return 0.99;
    }

    public function size(): Size
    {
        return $this->size;
    }
}
