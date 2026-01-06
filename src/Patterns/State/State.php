<?php

namespace App\Patterns\State;

use Prewk\Result;

interface State
{
    /** @return Result<string, string> */
    public function insertQuarter(): Result;

    /** @return Result<string, string> */
    public function ejectQuarter(): Result;

    /** @return Result<string, string> */
    public function turnCrank(): Result;

    /** @return Result<string, string> */
    public function dispense(): Result;

    /** @return Result<string, string> */
    public function refill(int $count): Result;
}
