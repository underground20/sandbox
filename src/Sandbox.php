<?php

namespace App;

use App\Strategy\Behavior\FlyNoWay;
use App\Strategy\Behavior\FlyWithWings;
use App\Strategy\Behavior\MuteQuack;
use App\Strategy\Behavior\Quack;
use App\Strategy\Duck;
use App\Strategy\MallardDuck;
use App\Strategy\RedheadDuck;
use App\Strategy\WoodDuck;

class Sandbox
{
    public function execute(): void
    {
        $quack = new Quack();
        $mallardDuck = new MallardDuck($quack, new FlyWithWings());
        $redHeadDuck = new RedheadDuck($quack, new FlyNoWay());
        $woodDuck = new WoodDuck(new MuteQuack(), new FlyNoWay());

        $ducks = [$mallardDuck, $redHeadDuck, $woodDuck];

        /** @var Duck $duck */
        foreach ($ducks as $duck) {
            echo $duck->display();
            $duck->quack();
            $duck->fly();
            echo '<hr>';
        }
    }
}