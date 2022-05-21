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
        $this->flyBehavior->bindTo($this)();
    }

    public function quack(): void
    {
        $this->quackBehavior->bindTo($this)();
    }

    public function dance(): void
    {
        if ($this->danceBehavior !== null) {
            $this->danceBehavior->bindTo($this)();
        }
    }

    public function changeFlyBehavior(callable $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function changeQuackBehavior(callable $quackBehavior): void
    {
        $this->quackBehavior = $quackBehavior;
    }

    public function changeDanceBehavior(callable $danceBehavior): void
    {
        $this->danceBehavior = $danceBehavior;
    }
}