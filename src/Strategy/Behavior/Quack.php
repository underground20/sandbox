<?php

namespace App\Strategy\Behavior;

class Quack implements QuackBehavior
{
    public function quack(): void
    {
        echo 'quack';
    }
}