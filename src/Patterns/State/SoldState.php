<?php

namespace App\Patterns\State;

use Prewk\Result;

final class SoldState implements State
{
    public function __construct(private GumballMachine $machine)
    {
    }

    /** @return Result<mixed, string> */
    public function insertQuarter(): Result
    {
        return new Result\Err('Dispense gumble');
    }

    /** @return Result<mixed, string> */
    public function ejectQuarter(): Result
    {
        return new Result\Err('Eject not allowed, crank was turned');
    }

    /** @return Result<mixed, string> */
    public function turnCrank(): Result
    {
        return new Result\Err('You already trunk crank');
    }

    /** @return Result<string, mixed> */
    public function dispense(): Result
    {
        $this->machine->decreaseCount();

        $result = new Result\Ok('Ok');
        if ($this->machine->count > 0) {
            $this->machine->changeState(new NoQuarterState($this->machine));

            return $result;
        }

        $this->machine->changeState(new SoldOutState($this->machine));

        return $result;
    }

    /** @return Result<mixed, string> */
    public function refill(int $count): Result
    {
        return new Result\Err('');
    }
}
