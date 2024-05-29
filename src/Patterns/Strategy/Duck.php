<?php

namespace App\Patterns\Strategy;

use App\Patterns\Strategy\Behavior\DanceBehavior;
use App\Patterns\Strategy\Behavior\FlyBehavior;
use App\Patterns\Strategy\Behavior\QuackBehavior;

abstract class Duck
{
    abstract public function display(): string;

    public function __construct(
        private QuackBehavior $quackBehavior,
        private FlyBehavior $flyBehavior,
        private ?DanceBehavior $danceBehavior = null
    ) {}

    public function fly(): string
    {
        return $this->flyBehavior->fly();
    }

    public function quack(): string
    {
        return $this->quackBehavior->quack();
    }

    public function dance(): string
    {
        if ($this->danceBehavior !== null) {
            return $this->danceBehavior->dance();
        }

        return '';
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
