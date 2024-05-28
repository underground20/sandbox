<?php

namespace App\Patterns\Strategy;

abstract class Duck
{
    abstract public function display(): string;

    /**
     * @param callable $quackBehavior
     * @param callable $flyBehavior
     * @param callable|null $danceBehavior
     */
    public function __construct(
        private $quackBehavior,
        private $flyBehavior,
        private $danceBehavior = null
    ) {}

    public function fly(): string
    {
        return call_user_func($this->flyBehavior);
    }

    public function quack(): string
    {
        return call_user_func($this->quackBehavior);
    }

    public function dance(): string
    {
        if ($this->danceBehavior !== null) {
            return call_user_func($this->danceBehavior);
        }

        return '';
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
