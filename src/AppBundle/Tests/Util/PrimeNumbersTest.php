<?php

namespace AppBundle\Tests\Util;

use AppBundle\Util\NumberPatternGenerator;
use AppBundle\Util\PrimeNumberHandler;
use PHPUnit\Framework\TestCase;

class PrimeNumbersTest extends TestCase
{
    private $numberPatternHandler;

    protected function setUp()
    {
        $this->numberPatternHandler = new NumberPatternGenerator();
    }

    protected function tearDown()
    {
        $this->numberPatternHandler = null;
    }

    public function testIfNumberIsPrime()
    {
        $primeNumberPattern = new PrimeNumberHandler();
        $this->assertTrue($primeNumberPattern->isInPattern(199));
    }

    public function test10FirstPrimeNumbers()
    {
        $first10PrimeNumbers = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29];

        $this->assertEquals($first10PrimeNumbers, $this->numberPatternHandler->getPrimeNumbers('prime'));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFirstNPrimeNumbers($numbers, $pattern, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->numberPatternHandler->getPrimeNumbers($pattern, $numbers));
    }

    public function dataProvider()
    {
        return [
            [
                5,
                'prime',
                [2, 3, 5, 7, 11]
            ],
            [
                15,
                'prime',
                [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47]
            ]
        ];
    }
}
