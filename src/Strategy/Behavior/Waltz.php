<?php

namespace App\Strategy\Behavior;

class Waltz implements DanceBehavior
{
    public function dance(): void
    {
        echo 'waltz';
    }
}