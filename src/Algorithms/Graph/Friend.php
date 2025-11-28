<?php

namespace App\Algorithms\Graph;

final class Friend
{
    /** @var array<Friend> $friends */
    private(set) array $friends = [];

    public function __construct(public readonly string $name, public readonly bool $isProgrammer = false)
    {
    }

    /** @param array<Friend> $friends */
    public function addFriends(array $friends): void
    {
        $this->friends = $friends;
    }

    public function hasFriends(): bool
    {
        return !empty($this->friends);
    }
}
