<?php

namespace App\Patterns\State;

use Prewk\Result;

final class HasQuarterState implements State
{
    private static int $count = 0;

    public function __construct(private GumballMachine $machine)
    {
    }

    /** @return Result<mixed, string> */
    public function insertQuarter(): Result
    {
        return new Result\Err('Quarter already inserted');
    }

    /** @return Result<string, mixed> */
    public function ejectQuarter(): Result
    {
        $this->machine->changeState(new NoQuarterState($this->machine));

        return new Result\Ok('Ok');
    }

    /** @return Result<string, mixed> */
    public function turnCrank(): Result
    {
        self::$count++;

        $result = new Result\Ok('Ok');
        if (self::$count % 3 === 0) {
            $this->machine->changeState(new WinnerState($this->machine));

            return $result;
        }

        $this->machine->changeState(new SoldState($this->machine));

        return $result;
    }

    /** @return Result<mixed, string> */
    public function dispense(): Result
    {
        return new Result\Err('Turn rank to dispense');
    }

    /** @return Result<mixed, string> */
    public function refill(int $count): Result
    {
        return new Result\Err('');
    }
}
