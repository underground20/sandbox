<?php

namespace App\Patterns\Strategy\Behavior;

class FlyWithWings implements FlyBehavior
{
    private static int $flightsCount = 0;

    public function fly(): string
    {
        self::$flightsCount++;

        return "flights count " . self::$flightsCount;
    }
}
