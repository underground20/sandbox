<?php

namespace Patterns\Strategy;

use App\Patterns\Strategy\Behavior\FlyNoWay;
use App\Patterns\Strategy\Behavior\FlyWithWings;
use App\Patterns\Strategy\Behavior\Minuet;
use App\Patterns\Strategy\Behavior\MuteQuack;
use App\Patterns\Strategy\Behavior\Quack;
use App\Patterns\Strategy\Behavior\Waltz;
use App\Patterns\Strategy\Duck;
use App\Patterns\Strategy\MallardDuck;
use App\Patterns\Strategy\RedheadDuck;
use App\Patterns\Strategy\WoodDuck;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DuckBehaviorTest extends TestCase
{
    public static function ducks(): array
    {
        return [
            [new MallardDuck(new Quack(), new FlyWithWings(), new Waltz()), '(mallard duck) quack: quack, fly: flights count 1, dance: waltz'],
            [new RedheadDuck(new Quack(), new FlyWithWings(), new Minuet()), '(red head duck) quack: quack, fly: flights count 2, dance: minuet'],
            [new WoodDuck(new MuteQuack(), new FlyNoWay()), '(wood duck) quack: -, fly: -, dance: -'],
        ];
    }

    #[DataProvider('ducks')]
    public function testBehaviorResult(Duck $duck, string $expectedResult): void
    {
        $quackResult = $duck->quack() ?: '-';
        $flyResult = $duck->fly() ?: '-';
        $danceResult = $duck->dance() ?: '-';

        $duckBehaviorResult = "({$duck->display()}) quack: $quackResult, fly: $flyResult, dance: $danceResult";
        $this->assertEquals($expectedResult, $duckBehaviorResult);
    }

    public function testChangeBehavior(): void
    {
        $mallardDuck = new MallardDuck(new Quack(), new FlyWithWings(), new Waltz());
        $quackResult = $mallardDuck->quack();

        $this->assertEquals('quack', $quackResult);

        $mallardDuck->changeQuackBehavior(new MuteQuack());

        $quackResultAfterChangeBehavior = $mallardDuck->quack();

        $this->assertEmpty($quackResultAfterChangeBehavior);
    }
}
