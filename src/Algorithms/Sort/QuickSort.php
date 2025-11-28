<?php

namespace App\Algorithms\Sort;

final class QuickSort
{
    /**
     * @param list<int> $array
     * @return list<int>
     */
    public static function v1(array $array): array
    {
        if (count($array) < 2) {
            return $array;
        }

        $pivot = $array[0];
        $less = array_values(array_filter($array, static fn(int $item) => $item < $pivot));
        $greater = array_values(array_filter($array, static fn(int $item) => $item > $pivot));

        return [...self::v1($less), $pivot, ...self::v1($greater)];
    }

    /**
     * @param list<int> $array
     * @return list<int>
     */
    public static function v2(array $array): array
    {
        if (count($array) < 2) {
            return $array;
        }

        $middleIndex = (int) floor(count($array) / 2);
        $pivot = $array[$middleIndex];
        $less = array_values(array_filter($array, static fn(int $item) => $item < $pivot));
        $greater = array_values(array_filter($array, static fn(int $item) => $item > $pivot));

        return [...self::v2($less), $pivot, ...self::v2($greater)];
    }

    /**
     * @param list<int> $array
     */
    public static function v3(array &$array): void
    {
        if (count($array) < 2) {
            return;
        }

        self::quickSort($array, 0, count($array) - 1);
    }

    private static function quickSort(array &$array, int $low, int $high): void
    {
        if ($low < $high) {
            $pivotIndex = self::partition($array, $low, $high);

            self::quickSort($array, $low, $pivotIndex - 1);
            self::quickSort($array, $pivotIndex + 1, $high);
        }
    }

    /**
     * @param list<int> $array
     */
    private static function partition(array &$array, int $low, int $high): int
    {
        $middle = (int) floor(($low + $high) / 2);
        $pivot = $array[$middle];

        self::swap($array, $middle, $high);

        $i = $low - 1;
        for ($j = $low; $j < $high; $j++) {
            if ($array[$j] <= $pivot) {
                $i++;
                self::swap($array, $i, $j);
            }
        }

        self::swap($array, $i + 1, $high);

        return $i + 1;
    }

    /**
     * @param list<int> $array
     */
    private static function swap(array &$array, int $i, int $j): void
    {
        $temp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $temp;
    }
}
