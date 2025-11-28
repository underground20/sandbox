<?php

namespace Test\Algorithms\Sort;

use App\Algorithms\Sort\QuickSort;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

final class QuickSortTest extends TestCase
{
    #[TestWith([[42, 17, 89, 3, 65, 21, 94, 55, 12, 73], [3, 12, 17, 21, 42, 55, 65, 73, 89, 94]])]
    #[TestWith([[5, 78, 34, 61, 29, 90, 44, 16, 87, 52], [5, 16, 29, 34, 44, 52, 61, 78, 87, 90]])]
    #[TestWith([[71, 9, 48, 63, 25, 82, 37, 59, 14, 96], [9, 14, 25, 37, 48, 59, 63, 71, 82, 96]])]
    #[TestWith([[28, 57, 11, 74, 43, 86, 19, 68, 32, 95], [11, 19, 28, 32, 43, 57, 68, 74, 86, 95]])]
    #[TestWith([[67, 23, 51, 84, 7, 49, 76, 35, 92, 18], [7, 18, 23, 35, 49, 51, 67, 76, 84, 92]])]
    public function testSortV1(array $array, array $expected): void
    {
        $sortedArr = QuickSort::v1($array);

        $this->assertSame($expected, $sortedArr);
    }

    #[TestWith([[42, 17, 89, 3, 65, 21, 94, 55, 12, 73], [3, 12, 17, 21, 42, 55, 65, 73, 89, 94]])]
    #[TestWith([[5, 78, 34, 61, 29, 90, 44, 16, 87, 52], [5, 16, 29, 34, 44, 52, 61, 78, 87, 90]])]
    #[TestWith([[71, 9, 48, 63, 25, 82, 37, 59, 14, 96], [9, 14, 25, 37, 48, 59, 63, 71, 82, 96]])]
    #[TestWith([[28, 57, 11, 74, 43, 86, 19, 68, 32, 95], [11, 19, 28, 32, 43, 57, 68, 74, 86, 95]])]
    #[TestWith([[67, 23, 51, 84, 7, 49, 76, 35, 92, 18], [7, 18, 23, 35, 49, 51, 67, 76, 84, 92]])]
    public function testSortV2(array $array, array $expected): void
    {
        $sortedArr = QuickSort::v2($array);

        $this->assertSame($expected, $sortedArr);
    }

    #[TestWith([[42, 17, 89, 3, 65, 21, 94, 55, 12, 73], [3, 12, 17, 21, 42, 55, 65, 73, 89, 94]])]
    #[TestWith([[5, 78, 34, 61, 29, 90, 44, 16, 87, 52], [5, 16, 29, 34, 44, 52, 61, 78, 87, 90]])]
    #[TestWith([[71, 9, 48, 63, 25, 82, 37, 59, 14, 96], [9, 14, 25, 37, 48, 59, 63, 71, 82, 96]])]
    #[TestWith([[28, 57, 11, 74, 43, 86, 19, 68, 32, 95], [11, 19, 28, 32, 43, 57, 68, 74, 86, 95]])]
    #[TestWith([[67, 23, 51, 84, 7, 49, 76, 35, 92, 18], [7, 18, 23, 35, 49, 51, 67, 76, 84, 92]])]
    public function testSortV3(array $array, array $expected): void
    {
        QuickSort::v3($array);

        $this->assertSame($expected, $array);
    }
}
