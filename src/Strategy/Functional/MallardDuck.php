<?php

namespace App\Strategy\Functional;

class MallardDuck extends Duck
{
    public function display(): string
    {
        return 'mallard duck';
    }
}