<?php

namespace App\Money;

readonly class Sum implements Expression
{
    public function __construct(
        public Expression $augend,
        public Expression $addend
    ) {}

    public function reduce(Bank $bank, Currency $to): Money
    {
        $amount = ($this->augend->reduce($bank, $to))->amount + ($this->addend->reduce($bank, $to))->amount;
        return new Money($amount, $to);
    }

    public function times(int $multiplier): Expression
    {
        return new self($this->augend->times($multiplier), $this->addend->times($multiplier));
    }

    public function plus(Expression $addend): Expression
    {
        return new self($this, $addend);
    }
}
