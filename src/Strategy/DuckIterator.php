<?php

namespace App\Strategy;

class DuckIterator implements \Iterator
{
    private \SplObjectStorage $ducks;

    public function __construct(\SplObjectStorage $ducks)
    {
        $this->ducks = $ducks;
    }

    public function current(): mixed
    {
        return $this->ducks->current();
    }

    public function next(): void
    {
        $this->ducks->next();
    }

    public function key(): int
    {
        return $this->ducks->key();
    }

    public function valid(): bool
    {
        return $this->ducks->valid();
    }

    public function rewind(): void
    {
        $this->ducks->rewind();
    }
}