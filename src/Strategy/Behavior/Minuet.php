<?php

namespace App\Strategy\Behavior;

class Minuet implements DanceBehavior
{
    public function dance(): void
    {
        echo 'minuet' . PHP_EOL;
    }
}