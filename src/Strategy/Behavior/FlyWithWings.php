<?php

namespace App\Strategy\Behavior;

class FlyWithWings implements FlyBehavior
{
    private static int $flightsCount = 0;

    public function fly(): void
    {
        self::$flightsCount++;

        echo 'simple fly <br>';
        echo "flights count " . self::$flightsCount . PHP_EOL;
    }
}