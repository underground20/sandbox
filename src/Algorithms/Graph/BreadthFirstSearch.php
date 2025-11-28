<?php

namespace App\Algorithms\Graph;

use Ds\Deque;

final class BreadthFirstSearch
{
    /**
     * @param array<Friend> $friends
     * @param callable(Friend): bool $condition
     */
    public static function search(array $friends, callable $condition): ?Friend
    {
        /** @var array<string, bool> $searched */
        $searched = [];
        /** @var Deque<Friend> $deque */
        $deque = new Deque($friends);
        while (!$deque->isEmpty()) {
            /** @var Friend $friend */
            $friend = $deque->shift();
            if (isset($searched[$friend->name])) {
                continue;
            }

            $searched[$friend->name] = true;
            if ($condition($friend)) {
                return $friend;
            }

            if ($friend->hasFriends()) {
                $deque->push(...$friend->friends);
            }
        }

        return null;
    }
}
