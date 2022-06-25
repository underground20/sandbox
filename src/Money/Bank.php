<?php

namespace App\Money;

use Ds\Map;

class Bank
{
    private const DEFAULT_RATE = 1;

    /** @param Map<Pair, int> $rates */
    public function __construct(
        private readonly Map $rates = new Map()
    ) {}

    public function reduce(Expression $source, Currency $currency): Money
    {
        return $source->reduce($this, $currency);
    }

    public function addRate(Currency $from, Currency $to, int $rate): void
    {
        $this->rates->put(new Pair($from, $to), $rate);
    }

    public function rate(Currency $from, Currency $to): int
    {
        if ($from->equals($to)) {
            return self::DEFAULT_RATE;
        }

        $pair = new Pair($from, $to);
        if (!$this->rates->hasKey($pair)) {
            throw new \DomainException("Rate from $from->value to $to->value was not added");
        }

        return (int) $this->rates->get($pair);
    }
}
