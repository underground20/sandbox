<?php

namespace App\Strategy;

use App\Strategy\Behavior\DanceBehavior;
use App\Strategy\Behavior\FlyBehavior;
use App\Strategy\Behavior\NoDance;
use App\Strategy\Behavior\QuackBehavior;

abstract class Duck
{
    abstract public function display(): string;

    public function __construct(
        private QuackBehavior $quackBehavior,
        private FlyBehavior $flyBehavior,
        private ?DanceBehavior $danceBehavior = new NoDance()
    ) {}

    public function fly(): void
    {
        $this->flyBehavior->fly();
    }

    public function quack(): void
    {
        $this->quackBehavior->quack();
    }

    public function dance(): void
    {
        $this->danceBehavior?->dance();
    }

    public function changeFlyBehavior(FlyBehavior $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function changeQuackBehavior(QuackBehavior $quackBehavior): void
    {
        $this->quackBehavior = $quackBehavior;
    }

    public function changeDanceBehavior(DanceBehavior $danceBehavior): void
    {
        $this->danceBehavior = $danceBehavior;
    }
}