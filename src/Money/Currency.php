<?php

namespace App\Money;

enum Currency: string
{
    case DOLLAR = 'USD';
    case FRANC = 'CHF';

    public function equals(self $currency): bool
    {
        return $this === $currency;
    }
}