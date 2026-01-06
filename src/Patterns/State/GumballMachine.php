<?php

namespace App\Patterns\State;

use Prewk\Result;

final class GumballMachine
{
    private(set) State $state;

    public function __construct(public int $count = 0)
    {
        if ($this->count > 0) {
            $this->state = new NoQuarterState($this);

            return;
        }

        $this->state = new SoldOutState($this);
    }

    public function changeState(State $state): void
    {
        $this->state = $state;
    }

    public function refill(int $count): void
    {
        $this->count += $count;
    }

    public function decreaseCount(): void
    {
        $this->count--;
    }

    /** @return Result<string, string> */
    public function insertQuarter(): Result
    {
        return $this->state->insertQuarter();
    }

    /** @return Result<string, string> */
    public function ejectQuarter(): Result
    {
        return $this->state->ejectQuarter();
    }

    /** @return Result<string, string> */
    public function turnCrank(): Result
    {
        $result = $this->state->turnCrank();
        if ($result->isErr()) {
            return $result;
        }

        return $this->state->dispense();
    }
}
