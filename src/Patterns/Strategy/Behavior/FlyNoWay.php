<?php

namespace App\Patterns\Strategy\Behavior;

class FlyNoWay implements FlyBehavior
{
    public function fly(): string
    {
        return '';
    }
}
