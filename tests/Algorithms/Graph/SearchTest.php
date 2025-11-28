<?php

namespace Test\Algorithms\Graph;

use App\Algorithms\Graph\BreadthFirstSearch;
use App\Algorithms\Graph\DijkstraAlgorithm;
use App\Algorithms\Graph\ExchangeGraph;
use App\Algorithms\Graph\Friend;
use App\Algorithms\Graph\Item;
use PHPUnit\Framework\TestCase;

final class SearchTest extends TestCase
{
    public function testSearchAmongFriendsNotProgrammer(): void
    {
        $items = [
            $book = new Item('book'),
            $plate = new Item('plate'),
            $poster = new Item('poster'),
            $guitar = new Item('guitar'),
            $drum = new Item('drum'),
            $piano = new Item('piano'),
        ];

        $graph = new ExchangeGraph();
        foreach ($items as $item) {
            $graph->addItem($item);
        }

        $graph->addExchange($book, $poster, 0.0);
        $graph->addExchange($book, $plate, 5.0);

        $graph->addExchange($plate, $guitar, 15.0);
        $graph->addExchange($plate, $drum, 20.0);

        $graph->addExchange($poster, $guitar, 30.0);
        $graph->addExchange($poster, $drum, 35.0);

        $graph->addExchange($guitar, $piano, 20.0);
        $graph->addExchange($drum, $piano, 10.0);

        $result = $graph->findCheapest($book, $piano);

        $this->assertSame(35.0, $result['cost']);
        $this->assertSame('book -> plate -> drum -> piano', $result['path']);
    }
}
