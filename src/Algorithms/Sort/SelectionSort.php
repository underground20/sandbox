<?php

namespace App\Algorithms\Sort;

final class SelectionSort
{
    /**
     * @param list<int> $elements
     * @return list<int>
     */
    public static function v1(array $elements): array
    {
        $newArr = [];
        foreach ($elements as $ignored) {
            $smallest = self::findSmallestElementIndex($elements);
            $newArr[] = $elements[$smallest];
            array_splice($elements, $smallest, 1);
        }

        return $newArr;
    }

    /**
     * @param list<int> $elements
     */
    public static function v2(array &$elements): void
    {
        $currentIndex = 0;
        foreach ($elements as $ignored) {
            $minIndex = self::findSmallestElementIndex($elements, $currentIndex);
            self::swap($elements, $currentIndex, $minIndex);
            $currentIndex++;
        }
    }

    /** @param list<int> $elements */
    private static function findSmallestElementIndex(array $elements, int $minIndex = 0): int
    {
        $smallest = $elements[$minIndex];
        $smallestIndex = $minIndex;
        foreach ($elements as $index => $element) {
            if ($minIndex > $index) {
                continue;
            }

            if ($element < $smallest) {
                $smallest = $element;
                $smallestIndex = $index;
            }
        }

        return $smallestIndex;
    }

    /**
     * @param list<int> $elements
     */
    private static function swap(array &$elements, int $i, int $j): void
    {
        $temp = $elements[$i];
        $elements[$i] = $elements[$j];
        $elements[$j] = $temp;
    }
}
