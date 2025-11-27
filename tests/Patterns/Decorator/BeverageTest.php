<?php

namespace Test\Patterns\Decorator;

use App\Patterns\Decorator\DarkRoast;
use App\Patterns\Decorator\Espresso;
use App\Patterns\Decorator\Mocha;
use App\Patterns\Decorator\Size;
use App\Patterns\Decorator\Soy;
use App\Patterns\Decorator\Whip;
use PHPUnit\Framework\TestCase;

final class BeverageTest extends TestCase
{
    public function testDecorate(): void
    {
        $beverage = new Whip(new Mocha(new DarkRoast()));

        $cost = $beverage->cost();
        $description = $beverage->getDescription();

        $this->assertSame(1.29, $cost);
        $this->assertSame('Dark roast + mocha + whip', $description);
    }

    public function testDecorateWithChangeSize(): void
    {
        $beverage = new Mocha(new Soy(new Espresso(Size::Big)));

        $cost = $beverage->cost();
        $description = $beverage->getDescription();

        $this->assertSame(1.99 + 0.2 + 0.2, $cost);
        $this->assertSame('Espresso + soy + mocha', $description);
    }
}
