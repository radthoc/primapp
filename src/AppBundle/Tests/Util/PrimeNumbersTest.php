<?php

namespace AppBundle\Tests\Util;

use AppBundle\Service\PatternHandlerProvider;
use AppBundle\Util\NumberPatternGenerator;
use AppBundle\Service\PrimeNumberService;
use PHPUnit\Framework\TestCase;

class PrimeNumbersTest extends TestCase
{
    private $numberPatternHandler;

    protected function setUp()
    {
        $patternHandlerProvider = new PatternHandlerProvider();
        $this->numberPatternHandler = new NumberPatternGenerator($patternHandlerProvider);
    }

    protected function tearDown()
    {
        $this->numberPatternHandler = null;
    }

    public function testIfNumberIsPrime()
    {
        $primeNumberPattern = new PrimeNumberService();
        $this->assertTrue($primeNumberPattern->isInPattern(199));
    }

    public function test10FirstPrimeNumbers()
    {
        $first10PrimeNumbers = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29];

        $this->assertEquals($first10PrimeNumbers, $this->numberPatternHandler->getNumbers('prime'));
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Invalid pattern
     */
    public function testInvalidPattern()
    {
        $numbers = $this->numberPatternHandler->getNumbers('odd');
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFirstNPrimeNumbers($numbers, $pattern, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->numberPatternHandler->getNumbers($pattern, $numbers));
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
