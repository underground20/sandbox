<?php

namespace Test\Money;

use App\Money\Bank;
use App\Money\Currency;
use App\Money\Money;
use App\Money\Sum;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication(): void
    {
        $five = Money::dollar(5);
        self::assertEquals(Money::dollar(10), $five->times(2));
        self::assertEquals(Money::dollar(15), $five->times(3));

        $ten = Money::franc(10);
        self::assertEquals(Money::franc(20), $ten->times(2));
        self::assertEquals(Money::franc(30), $ten->times(3));
    }

    public function testEquality(): void
    {
        self::assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
        self::assertFalse((Money::dollar(6))->equals(Money::dollar(5)));
        self::assertFalse((Money::dollar(5))->equals(Money::franc(5)));
    }

    public function testCurrency(): void
    {
        self::assertEquals(Currency::DOLLAR, (Money::dollar(1))->currency);
        self::assertEquals(Currency::FRANC, (Money::franc(1))->currency);
    }

    public function testSimpleAddition(): void
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $bank = new Bank();
        $reduced = $bank->reduce($sum, Currency::DOLLAR);
        self::assertEquals(Money::dollar(10), $reduced);
        self::assertEquals($five, $sum->augend);
        self::assertEquals($five, $sum->addend);
    }

    public function testReduceSum(): void
    {
        $sum = new Sum(Money::dollar(3), Money::dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, Currency::DOLLAR);
        self::assertEquals(Money::dollar(7), $result);
    }

    public function testReduceMoney(): void
    {
        $bank = new Bank();
        $bank->addRate(Currency::DOLLAR, Currency::DOLLAR, 1);
        $result = $bank->reduce(Money::dollar(1), Currency::DOLLAR);
        self::assertEquals(Money::dollar(1), $result);
    }

    public function testReduceMoneyWithDifferentCurrency(): void
    {
        $bank = new Bank();
        $bank->addRate(Currency::FRANC, Currency::DOLLAR, 2);
        $result = $bank->reduce(Money::franc(2), Currency::DOLLAR);

        self::assertEquals(Money::dollar(1), $result);
    }

    public function testIdentityRate(): void
    {
        self::assertEquals(1, (new Bank())->rate(Currency::DOLLAR, Currency::DOLLAR));
    }

    public function testMixedAddition(): void
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate(Currency::FRANC, Currency::DOLLAR, 2);
        $result = $bank->reduce($fiveBucks->plus($tenFrancs), Currency::DOLLAR);

        self::assertEquals(Money::dollar(10), $result);
    }

    public function testSumPlusMoney(): void
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate(Currency::FRANC, Currency::DOLLAR, 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->plus($fiveBucks);
        $result = $bank->reduce($sum, Currency::DOLLAR);

        self::assertEquals(Money::dollar(15), $result);
    }

    public function testSumTimes(): void
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate(Currency::FRANC, Currency::DOLLAR, 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->times(2);
        $result = $bank->reduce($sum, Currency::DOLLAR);

        self::assertEquals(Money::dollar(20), $result);
    }

    public function testThrowExceptionWhenRateNotAdded(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Rate from CHF to USD was not added");

        $bank = new Bank();
        $bank->reduce(Money::franc(2), Currency::DOLLAR);
    }
}
