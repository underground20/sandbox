<?php

namespace App\Money;

interface Expression
{
    public function reduce(Bank $bank, Currency $to): Money;

    public function times(int $multiplier): Expression;

    public function plus(Expression $addend): Expression;
}