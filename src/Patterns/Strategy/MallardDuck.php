<?php

namespace App\Patterns\Strategy;

class MallardDuck extends Duck
{
    public function display(): string
    {
        return 'mallard duck';
    }
}
