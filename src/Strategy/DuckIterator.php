<?php

namespace App\Strategy;

/** @implements \Iterator<Duck> */
class DuckIterator implements \Iterator
{
    /** @var \SplObjectStorage<Duck, null> */
    private \SplObjectStorage $ducks;

    /** @param \SplObjectStorage<Duck, null> $ducks */
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
