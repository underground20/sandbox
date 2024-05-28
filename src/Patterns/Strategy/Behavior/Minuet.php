<?php

namespace App\Patterns\Strategy\Behavior;

use Prewk\Result;

class Minuet implements DanceBehavior
{
    public function dance(): string
    {
        return 'minuet';
    }
}
