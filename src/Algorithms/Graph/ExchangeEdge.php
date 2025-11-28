<?php

namespace App\Algorithms\Graph;

final class ExchangeEdge
{
    public function __construct(
        public readonly Item $from,
        public readonly Item $to,
        public readonly float $price,
    ) {
    }
}
