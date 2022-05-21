<?php

namespace App;

use App\Strategy\Behavior\FlyNoWay;
use App\Strategy\Behavior\FlyWithWings;
use App\Strategy\Behavior\Minuet;
use App\Strategy\Behavior\MuteQuack;
use App\Strategy\Behavior\Quack;
use App\Strategy\Behavior\Waltz;
use App\Strategy\Duck;
use App\Strategy\MallardDuck;
use App\Strategy\RedheadDuck;
use App\Strategy\WoodDuck;
use App\Strategy\Functional\MallardDuck as FunctionalMallardDuck;
use App\Strategy\Functional\RedheadDuck as FunctionalRedheadDuck;

class Sandbox
{
    public function execute(): void
    {
        $quack = new Quack();
        $mallardDuck = new MallardDuck($quack, new FlyWithWings(), new Waltz());
        $redHeadDuck = new RedheadDuck($quack, new FlyWithWings(), new Minuet());
        $woodDuck = new WoodDuck(new MuteQuack(), new FlyNoWay());

        $ducks = [$mallardDuck, $redHeadDuck, $woodDuck];

        /** @var Duck $duck */
        foreach ($ducks as $duck) {
            echo $duck->display() . '<br>';
            $duck->quack();
            echo '<br>';
            $duck->fly();
            echo '<br>';
            $duck->dance();
            echo '<hr>';
        }
    }

    public function executeFunctional(): void
    {
        // use \Closure::fromCallable('quack') before php 8.1, equal quack(...)
        $mallardDuck = new FunctionalMallardDuck(quack(...), flyWithWings(...));
        $redHeadDuck = new FunctionalRedheadDuck(quack(...), flyWithWings(...), danceMinuet(...));

        $ducks = [$mallardDuck, $redHeadDuck];
        /** @var \App\Strategy\Functional\Duck $duck */
        foreach ($ducks as $duck) {
            echo $duck->display() . "<br>";
            $duck->fly();
            $duck->quack();
            $duck->dance();
            echo '<hr>';
        }

        $redHeadDuck->changeFlyBehavior(\flyNoWay(...));
        $redHeadDuck->fly();
    }
}