<?php

namespace App\Patterns\State;

use Prewk\Result;

final class NoQuarterState implements State
{
    public function __construct(private GumballMachine $machine)
    {
    }

    /** @return Result<string, mixed> */
    public function insertQuarter(): Result
    {
        $this->machine->changeState(new HasQuarterState($this->machine));

        return new Result\Ok('Ok');
    }

    /** @return Result<mixed, string> */
    public function ejectQuarter(): Result
    {
        return new Result\Err('No quarter to eject');
    }

    /** @return Result<mixed, string> */
    public function turnCrank(): Result
    {
        return new Result\Err('Add quarter please');
    }

    /** @return Result<mixed, string> */
    public function dispense(): Result
    {
        return new Result\Err('Turn crank before dispense');
    }

    /** @return Result<string, mixed> */
    public function refill(int $count): Result
    {
        $this->machine->refill($count);

        return new Result\Ok('Ok');
    }
}
