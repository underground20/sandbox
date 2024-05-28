<?php

namespace App\Patterns\Strategy;

class RedheadDuck extends Duck
{
    public function display(): string
    {
        return 'red head duck';
    }
}
