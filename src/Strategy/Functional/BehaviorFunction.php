<?php

function quack(): void {
    echo 'quack' . PHP_EOL;
}

function muteQuack(): void {}

function danceWaltz(): void
{
    echo 'Waltz' . PHP_EOL;
}

function danceMinuet(): void
{
    echo 'Minuet' . PHP_EOL;
}

function noDance(): void {}

function flyWithWings(): void {
    static $flightCount = 0;
    echo 'simple fly' . PHP_EOL;
    $flightCount++;

    echo "Count $flightCount";
}

function flyNoWay(): void {}