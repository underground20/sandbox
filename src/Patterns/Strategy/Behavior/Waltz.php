<?php

namespace App\Patterns\Strategy\Behavior;

class Waltz implements DanceBehavior
{
    public function dance(): string
    {
        return 'waltz';
    }
}
