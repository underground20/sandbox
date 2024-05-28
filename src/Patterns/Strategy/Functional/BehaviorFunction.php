<?php

function quack(): string {
    return 'quack';
}

function muteQuack(): string {
    return '';
}

function danceWaltz(): string
{
    return 'Waltz';
}

function danceMinuet(): string
{
    return 'Minuet';
}

function noDance(): string {
    return '';
}

function flyWithWings(): string {
    static $flightCount = 0;
    $flightCount++;

    return "flights count $flightCount";
}

function flyNoWay(): string {
    return '';
}
