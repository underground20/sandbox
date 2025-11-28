<?php

namespace Test\Algorithms\Graph;

use App\Algorithms\Graph\BreadthFirstSearch;
use App\Algorithms\Graph\Friend;
use PHPUnit\Framework\TestCase;

final class BreadthFirstSearchTest extends TestCase
{
    public function testSearchAmongFriendsNotProgrammer(): void
    {
        $friends = [
            $alice = new Friend('alice'),
            $bob = new Friend('bob'),
            $clair = new Friend('claire')
        ];

        $peggy = new Friend('peggy');
        $alice->addFriends([$peggy]);
        $bob->addFriends([
            new Friend('anuj'),
            $peggy,
        ]);
        $clair->addFriends([
            new Friend('tom'),
            new Friend('jonny'),
        ]);

        $friend = BreadthFirstSearch::search($friends, static fn(Friend $friend): bool => $friend->isProgrammer);

        $this->assertNull($friend);
    }

    public function testFoundFriendProgrammer(): void
    {
        $friends = [
            $alice = new Friend('alice'),
            $bob = new Friend('bob'),
            $clair = new Friend('claire')
        ];

        $peggy = new Friend('peggy');
        $alice->addFriends([$peggy]);
        $bob->addFriends([
            $peggy,
            new Friend('anuj', true),
        ]);
        $clair->addFriends([
            new Friend('tom'),
            new Friend('jonny'),
        ]);

        $friend = BreadthFirstSearch::search($friends, static fn(Friend $friend): bool => $friend->isProgrammer);

        $this->assertSame('anuj', $friend->name);
    }

    public function testFoundFriendWithNameEndsWith(): void
    {
        $friends = [
            $alice = new Friend('alice'),
            $bob = new Friend('bob'),
            $clair = new Friend('claire')
        ];

        $peggy = new Friend('peggy');
        $alice->addFriends([$peggy]);
        $bob->addFriends([
            $peggy,
            new Friend('anuj', true),
        ]);
        $clair->addFriends([
            new Friend('tom'),
            new Friend('jonny'),
        ]);

        $friend = BreadthFirstSearch::search($friends, static fn(Friend $friend): bool => str_ends_with($friend->name, 'y'));

        $this->assertSame('peggy', $friend->name);
    }
}
