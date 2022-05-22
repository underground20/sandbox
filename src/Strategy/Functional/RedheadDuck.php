<?php

namespace App\Strategy\Functional;

class RedheadDuck extends Duck
{
    public function display(): string
    {
        return 'red head duck';
    }
}