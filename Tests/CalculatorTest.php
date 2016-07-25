<?php
use PHPUnit\Framework\TestCase;
include(__DIR__."/../Controller/Calculator.php");

/**
 * Test cases for the Calculator class
 *
 * User: Alice
 * Date: 16/07/16
 * Time: 9:42 AM
 */
class CalculatorTest extends TestCase
{
    private function getObject($a, $b, $c)
    {
        return new Calculator($a, $b, html_entity_decode($c));
    }
    /**
     * @dataProvider providerMultiplying
     */
    public function testMultiplying($a, $b, $c)
    {
        $g = $this->getObject($a, $b, '&times;');
        $this->assertEquals($c, $g->getResult());
    }

    /**
     * @dataProvider providerSubtraction
     */
    public function testSubtraction($a, $b, $c)
    {
        $g = $this->getObject($a, $b, '&minus;');
        $this->assertEquals($c, $g->getResult());
    }

    /**
     * @dataProvider providerAdding
     */
    public function testAdding($a, $b, $c)
    {
        $g = $this->getObject($a, $b, '+');
        $this->assertEquals($c, $g->getResult());
    }

    /**
     * @dataProvider providerDividing
     */
    public function testDividing($a, $b, $c)
    {
        $g = $this->getObject($a, $b, '&divide;');
        $this->assertEquals($c, $g->getResult());
    }

    public function testDividingByZero()
    {
        $this->expectOutputString('{"error":"Division by zero"}');
        $g = $this->getObject("5", "0", '&divide;');
        print $g->getResult();
    }

    public function testFirstOperandIsNotNum()
    {
        $this->expectOutputString('{"error":"The first argument is not set"}');
        $g = $this->getObject("", "8", '&divide;');
        print $g->getResult();
    }

    public function testSecondOperandIsNotNum()
    {
        $this->expectOutputString('{"error":"The second argument is not set"}');
        $g = $this->getObject("8", "", '&divide;');
        print $g->getResult();
    }

    public function testArithmeticSymbolNotExists()
    {
        $this->expectOutputString('{"error":"The arithmetic symbol <b>&amp;<\/b> doesn\'t exist"}');
        $g = $this->getObject("8", "9", '&');
        print $g->getResult();
    }

    public function providerMultiplying ()
    {
        return array (
            array ("2", "4", 8),
            array ("2", "30", 60),
        );
    }

    public function providerSubtraction ()
    {
        return array (
            array ("2", "4", -2),
            array ("65", "5", 60),
        );
    }

    public function providerAdding ()
    {
        return array (
            array ("2", "4", 6),
            array ("-65", "5", -60),
        );
    }

    public function providerDividing ()
    {
        return array (
            array ("4", "2", 2),
            array ("0", "5", 0),
        );
    }
}