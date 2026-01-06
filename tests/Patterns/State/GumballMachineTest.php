<?php

namespace Test\Patterns\State;

use App\Patterns\Observer\Output;
use App\Patterns\State\GumballMachine;
use App\Patterns\State\NoQuarterState;
use App\Patterns\State\SoldOutState;
use PHPUnit\Framework\TestCase;

final class GumballMachineTest extends TestCase
{
    public function testRefill(): void
    {
        $machine = new GumballMachine(3);
        $machine->insertQuarter();
        $machine->turnCrank();
        $machine->insertQuarter();
        $machine->turnCrank();

        $machine->refill(5);

        $this->assertSame(6, $machine->count);
    }

    public function testGetGumble(): void
    {
        $machine = new GumballMachine(10);
        $machine->insertQuarter();
        $machine->turnCrank();

        $this->assertSame(9, $machine->count);
        $this->assertInstanceOf(NoQuarterState::class, $machine->state);
    }

    public function testGetGumbleTwice(): void
    {
        $machine = new GumballMachine(10);
        for ($i = 1; $i <= 3; $i++) {
            $machine->insertQuarter();
            $machine->turnCrank();
        }

        $this->assertSame(6, $machine->count);
        $this->assertInstanceOf(NoQuarterState::class, $machine->state);
    }

    public function testGetGumbleFromEmptyMachine(): void
    {
        $machine = new GumballMachine(0);
        $result = $machine->insertQuarter();

        $this->assertSame('No gumballs', $result->unwrapErr());
    }

    public function testEjectQuarter(): void
    {
        $machine = new GumballMachine(1);
        $machine->insertQuarter();
        $machine->ejectQuarter();

        $this->assertInstanceOf(NoQuarterState::class, $machine->state);
    }

    public function testEjectQuarterWithoutInsertBefore(): void
    {
        $machine = new GumballMachine(1);
        $result = $machine->ejectQuarter();

        $this->assertSame('No quarter to eject', $result->unwrapErr());
    }

    public function testGetGumbleWithoutQuarter(): void
    {
        $machine = new GumballMachine(1);
        $machine->turnCrank();

        $this->assertInstanceOf(NoQuarterState::class, $machine->state);
    }

    public function testGetLastGumble(): void
    {
        $machine = new GumballMachine(1);
        $machine->insertQuarter();
        $machine->turnCrank();

        $this->assertSame(0, $machine->count);
        $this->assertInstanceOf(SoldOutState::class, $machine->state);
    }
}
