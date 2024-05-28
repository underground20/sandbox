<?php

namespace App\Patterns\Strategy;

class WoodDuck extends Duck
{
    public function display(): string
    {
        return 'wood duck';
    }
}
