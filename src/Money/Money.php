<?php

namespace App\Money;

readonly class Money implements Expression
{
    public function __construct(
        public int $amount,
        public Currency $currency
    ) {}

    public function times(int $multiplier): Expression
    {
        return new self($this->amount * $multiplier, $this->currency);
    }

    public function plus(Expression $addend): Sum
    {
        return new Sum($this, $addend);
    }

    public static function dollar(int $amount): Money
    {
        return new self($amount, Currency::DOLLAR);
    }

    public static function franc(int $amount): Money
    {
        return new self($amount, Currency::FRANC);
    }

    public function equals(self $money): bool
    {
        return $this->amount === $money->amount && $this->currency === $money->currency;
    }

    public function reduce(Bank $bank, Currency $to): self
    {
        $rate = $bank->rate($this->currency, $to);

        return new Money($this->amount / $rate, $to);
    }
}
