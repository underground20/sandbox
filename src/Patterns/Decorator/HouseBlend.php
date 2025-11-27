<?php

namespace App\Patterns\Decorator;

final readonly class HouseBlend implements Beverage
{
    public function __construct(private Size $size = Size::Normal)
    {
    }

    public function getDescription(): string
    {
        return 'House blend';
    }

    public function cost(): float
    {
        return 0.89;
    }

    public function size(): Size
    {
        return $this->size;
    }
}
