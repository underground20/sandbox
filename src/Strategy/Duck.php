<?php

namespace App\Strategy;

use App\Strategy\Behavior\FlyBehavior;
use App\Strategy\Behavior\QuackBehavior;

abstract class Duck
{
    abstract public function display(): string;

    public function __construct(
        private QuackBehavior $quackBehavior,
        private FlyBehavior $flyBehavior
    ) {}

    public function fly(): void
    {
        $this->flyBehavior->fly();
    }

    public function quack(): void
    {
        $this->quackBehavior->quack();
    }

    public function changeFlyBehavior(FlyBehavior $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function changeQuackBehavior(QuackBehavior $quackBehavior): void
    {
        $this->quackBehavior = $quackBehavior;
    }
}