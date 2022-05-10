<?php

namespace App\Strategy\Behavior;

class FlyWithWings implements FlyBehavior
{
    public function fly(): void
    {
        echo 'simple fly';
    }
}