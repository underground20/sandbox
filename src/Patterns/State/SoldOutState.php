<?php

namespace App\Patterns\State;

use Prewk\Result;

final class SoldOutState implements State
{
    private const string MESSAGE = 'No gumballs';

    public function __construct(private GumballMachine $machine)
    {
    }

    /** @return Result<mixed, string> */
    public function insertQuarter(): Result
    {
        return new Result\Err(self::MESSAGE);
    }

    /** @return Result<mixed, string> */
    public function ejectQuarter(): Result
    {
        return new Result\Err(self::MESSAGE);
    }

    /** @return Result<mixed, string> */
    public function turnCrank(): Result
    {
        return new Result\Err(self::MESSAGE);
    }

    /** @return Result<mixed, string> */
    public function dispense(): Result
    {
        return new Result\Err(self::MESSAGE);
    }

    /** @return Result<string, mixed> */
    public function refill(int $count): Result
    {
        $this->machine->refill($count);
        $this->machine->changeState(new NoQuarterState($this->machine));

        return new Result\Ok('Ok');
    }
}
