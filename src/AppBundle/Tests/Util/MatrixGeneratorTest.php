<?php

namespace AppBundle\Tests\Util;

use AppBundle\Util\MatrixGenerator;
use PHPUnit\Framework\TestCase;

class MatrixGeneratorTest extends TestCase
{
    public function testGenerateMatrix()
    {
        $numbers = [2, 3, 7, 11];

        $expectedMatrix = [
            [ 0, 2, 3, 7, 11 ],
            [ 2, 4, 6, 14, 22 ],
            [ 3, 6, 9, 21, 33 ],
            [ 7, 14, 21, 49, 77 ],
            [ 11, 22, 33, 77, 121 ]
        ];

        $matrixGenerator = new MatrixGenerator();
        $this->assertEquals($expectedMatrix, $matrixGenerator->create($numbers));
    }
}
