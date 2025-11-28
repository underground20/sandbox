<?php

namespace App\Algorithms;

final class BinarySearch
{
    /** @param list<int> $elements */
    public static function find(array $elements, int $item): ?int
    {
        $low = 0;
        $high = count($elements) - 1;
        while ($low <= $high) {
            $middleIndex = (int) floor(($low + $high) / 2);
            $guess = $elements[$middleIndex];
            if ($item === $guess) {
                return $middleIndex;
            }

            if ($guess > $item) {
                $high = $middleIndex - 1;
            }

            if ($guess < $item) {
                $low = $middleIndex + 1;
            }
        }

        return null;
    }
}
