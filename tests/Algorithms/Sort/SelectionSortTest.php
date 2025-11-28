<?php

namespace Test\Algorithms\Sort;

use App\Algorithms\Sort\SelectionSort;
use PHPUnit\Framework\TestCase;

final class SelectionSortTest extends TestCase
{
    public function testSortV1(): void
    {
        $arr = [100, 50, 1, 5, 26, 39];

        $sortedArr = SelectionSort::v1($arr);

        $this->assertSame([1, 5, 26, 39, 50, 100], $sortedArr);
    }

    public function testSortV2(): void
    {
        $arr = [100, 50, 1, 5, 26, 39];

        SelectionSort::v2($arr);

        $this->assertSame([1, 5, 26, 39, 50, 100], $arr);
    }
}
