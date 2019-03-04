<?php

namespace App\Tests;

use App\Entity\Operation;
use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdding()
    {
        $calculator = new Calculator();

        $this->assertTrue(9 == $calculator->calculate((new Operation())->setValue("4 + 5")));
        $this->assertTrue(2 == $calculator->calculate((new Operation())->setValue("1 + 1")));
        $this->assertTrue(13 == $calculator->calculate((new Operation())->setValue("1 + 3 + 9")));
        $this->assertTrue(20 == $calculator->calculate((new Operation())->setValue("10 + 1 + 9")));
        $this->assertTrue(30 == $calculator->calculate((new Operation())->setValue("10 + 10 + 10")));
        $this->assertTrue(33 == $calculator->calculate((new Operation())->setValue("3 + 10 + 10 + 10")));
    }

    public function testSubing()
    {
        $calculator = new Calculator();

        $this->assertTrue(-1 == $calculator->calculate((new Operation())->setValue("4 - 5")));
        $this->assertTrue(0 == $calculator->calculate((new Operation())->setValue("1 - 1")));
//        $this->assertTrue(-13 == $calculator->calculate((new Operation())->setValue("-1 - 3 - 9")));
        $this->assertTrue(0 == $calculator->calculate((new Operation())->setValue("10 - 1 - 9")));
        $this->assertTrue(-10 == $calculator->calculate((new Operation())->setValue("10 - 10 - 10")));
//        $this->assertTrue(-33 == $calculator->calculate((new Operation())->setValue("-3 - 10 - 10 - 10")));

        $this->markTestIncomplete("Pending: the need to implement the -X at the beginning of the string");
    }

    public function testAddingAndSubing()
    {
        $calculator = new Calculator();

        $this->assertTrue(-1 == $calculator->calculate((new Operation())->setValue("4 - 5")));
        $this->assertTrue(0 == $calculator->calculate((new Operation())->setValue("1 - 1")));
//        $this->assertTrue(11 == $calculator->calculate((new Operation())->setValue("-1 + 3 + 9")));
        $this->assertTrue(18 == $calculator->calculate((new Operation())->setValue("10 - 1 + 9")));
        $this->assertTrue(-10 == $calculator->calculate((new Operation())->setValue("10 - 10 - 10")));
//        $this->assertTrue(-13 == $calculator->calculate((new Operation())->setValue("-3 - 10 + 10 - 10")));

        $this->markTestIncomplete("Pending: the need to implement the -X at the beginning of the string");
    }

    public function testMultiplying()
    {
        $calculator = new Calculator();

        $this->assertTrue(20 == $calculator->calculate((new Operation())->setValue("4 * 5")));
        $this->assertTrue(8 == $calculator->calculate((new Operation())->setValue("4 * 2")));
        $this->assertTrue(24 == $calculator->calculate((new Operation())->setValue("4 * 2 * 3")));
        $this->assertTrue(100 == $calculator->calculate((new Operation())->setValue("4 * 5 * 1 * 5")));
        $this->assertTrue(0 == $calculator->calculate((new Operation())->setValue("4 * 0 * 1 * 5")));
    }
}
