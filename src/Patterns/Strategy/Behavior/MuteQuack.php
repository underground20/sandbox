<?php

namespace App\Patterns\Strategy\Behavior;

class MuteQuack implements QuackBehavior
{
    public function quack(): string
    {
        return '';
    }
}
