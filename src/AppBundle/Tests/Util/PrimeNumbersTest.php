<?php

namespace AppBundle\Tests\Util;

use AppBundle\Util\PrimeNumbers;
use PHPUnit\Framework\TestCase;

class PrimeNumbersTest extends TestCase
{
    private $primeNumbersService;

    protected function setUp()
    {
        $this->primeNumbersService = new PrimeNumbers();
    }

    protected function tearDown()
    {
        $this->primeNumbersService = NULL;
    }

    public function testIfNumberIsPrime()
    {
        $this->assertTrue($this->primeNumbersService->isPrime(199));
    }

    public function test10FirstPrimeNumbers()
    {
        $first10PrimeNumbers = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29];

        $this->assertEquals($first10PrimeNumbers, $this->primeNumbersService->getPrimeNumbers());
    }
    /**
     * @dataProvider dataProvider
     */
    public function testFirstNPrimeNumbers($numberOfPrimes, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->primeNumbersService->getPrimeNumbers($numberOfPrimes));
    }

    public function dataProvider()
    {
        return [
            [
                5,
                [2, 3, 5, 7, 11]
            ],
            [
                15,
                [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47]
            ]
        ];
    }
}