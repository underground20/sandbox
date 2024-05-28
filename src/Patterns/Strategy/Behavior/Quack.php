<?php

namespace App\Patterns\Strategy\Behavior;

class Quack implements QuackBehavior
{
    public function quack(): string
    {
        return 'quack';
    }
}
