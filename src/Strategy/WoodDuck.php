<?php

namespace App\Strategy;

class WoodDuck extends Duck
{
    public function display(): string
    {
        return 'wood duck';
    }
}