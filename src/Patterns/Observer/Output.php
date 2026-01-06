<?php

namespace App\Patterns\Observer;

final class Output
{
    /** @param list<string> $messages */
    public function __construct(private(set) array $messages = [])
    {
    }

    public function addMessage(string $message): void
    {
        $this->messages[] = $message;
    }
}
