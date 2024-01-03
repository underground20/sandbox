<?php

namespace App\Strategy;

use Traversable;

/** @implements \IteratorAggregate<Duck> */
class DuckCollection implements \IteratorAggregate
{
    /** @var \SplObjectStorage<Duck, null> */
    private \SplObjectStorage $ducks;

    public function __construct()
    {
        $this->ducks = new \SplObjectStorage();
    }

    public function addDuck(Duck $duck): void
    {
        $this->ducks->attach($duck);
    }

    public function removeDuck(Duck $duck): void
    {
        $this->ducks->detach($duck);
    }

    public function getIterator(): Traversable
    {
        return new DuckIterator($this->ducks);
    }
}
