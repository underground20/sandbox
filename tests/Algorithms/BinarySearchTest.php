<?php

namespace Test\Algorithms;

use App\Algorithms\BinarySearch;
use PHPUnit\Framework\TestCase;

final class BinarySearchTest extends TestCase
{
    public function testFound(): void
    {
        $arr = [1, 3, 7, 20, 40, 50, 52, 67, 87, 100];

        $index = BinarySearch::find($arr, 87);

        $this->assertSame(8, $index);
    }

    public function testNotFound(): void
    {
        $arr = [1, 3, 7, 20, 40, 50, 52, 67, 87, 100];

        $index = BinarySearch::find($arr, 5);

        $this->assertNull($index);
    }
}
