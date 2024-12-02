<?php

namespace App\Money;

use Ds\Hashable;

readonly class Pair implements Hashable
{
    public function __construct(
        public Currency $from,
        public Currency $to
    ) {}

    /** @param Pair $obj */
    public function equals(mixed $obj): bool
    {
        return $this->from->equals($obj->from) && $this->to->equals($obj->to);
    }

    public function hash(): int
    {
        return 0;
    }
}
