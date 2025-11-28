<?php

namespace App\Algorithms\Graph;

final class ExchangeGraph
{
    /** @var array<string, Item> */
    private array $items = [];
    /** @var array<array<string, ExchangeEdge> */
    private array $edges = [];

    public function addItem(Item $item): void
    {
        $this->items[$item->name] = $item;
    }

    /** @return array<string, ExchangeEdge> */
    public function getNeighbors(string $item): array
    {
        return $this->edges[$item] ?? [];
    }

    public function addExchange(
        Item $from,
        Item $to,
        float $price
    ): void {
        if (!isset($this->items[$from->name], $this->items[$to->name])) {
            throw new \InvalidArgumentException('Item not found');
        }

        $edge = new ExchangeEdge(
            $this->items[$from->name],
            $this->items[$to->name],
            $price
        );

        $this->edges[$from->name][$to->name] = $edge;
    }

    public function findCheapest(Item $start, Item $target): array
    {
        $costs = array_fill_keys(array_keys($this->items), INF);
        $costs[$start->name] = 0.0;

        $visited = [];
        $previous = [];
        while (count($visited) < count($this->items)) {
            $current = $this->getUnvisitedNode($costs, $visited);
            if ($current === null || $costs[$current] === INF) {
                break;
            }

            $visited[$current] = true;

            foreach ($this->getNeighbors($current) as $neighborId => $edge) {
                $newDistance = $costs[$current] + $edge->price;

                if ($newDistance < $costs[$neighborId]) {
                    $costs[$neighborId] = $newDistance;
                    $previous[$neighborId] = $current;
                }
            }
        }

        if ($costs[$target->name] === INF) {
            return [];
        }

        return [
            'cost' => $costs[$target->name],
            'path' => implode(' -> ', $this->reconstructPath($previous, $start->name, $target->name)),
        ];
    }

    private function getUnvisitedNode(array $costs, array $visited): ?string
    {
        $minCost = INF;
        $nextNode = null;
        foreach ($costs as $name => $cost) {
            if (!isset($visited[$name]) && $cost < $minCost) {
                $minCost = $cost;
                $nextNode = $name;
            }
        }

        return $nextNode;
    }

    private function reconstructPath(array $previous, string $start, string $target): array
    {
        $path = [];
        $current = $target;

        while ($current !== $start) {
            array_unshift($path, $current);
            $current = $previous[$current];
        }

        array_unshift($path, $start);
        return $path;
    }
}
