<?php

namespace App\Strategy\Functional;

use Closure;

abstract class Duck
{
    abstract public function display(): string;

    public function __construct(
        private Closure $quackBehavior,
        private Closure $flyBehavior,
        private ?Closure $danceBehavior = null
    ) {}

    public function fly(): void
    {
        /** @var Closure $fly */
        $fly = $this->flyBehavior->bindTo($this);
        $fly();
    }

    public function quack(): void
    {
        /** @var Closure $quack */
        $quack = $this->quackBehavior->bindTo($this);
        $quack();
    }

    public function dance(): void
    {
        if ($this->danceBehavior !== null) {
            /** @var Closure $dance */
            $dance = $this->danceBehavior->bindTo($this);
            $dance();
        }
    }

    public function changeFlyBehavior(callable $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior(...);
    }

    public function changeQuackBehavior(callable $quackBehavior): void
    {
        $this->quackBehavior = $quackBehavior(...);
    }

    public function changeDanceBehavior(callable $danceBehavior): void
    {
        $this->danceBehavior = $danceBehavior(...);
    }
}
