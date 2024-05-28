<?php

namespace App\Patterns\Strategy\Behavior;

class NoDance implements DanceBehavior
{
    public function dance(): string
    {
        return '';
    }
}
