<?php

namespace AppBundle\Util;

/**
 * Class MatrixGenerator
 * @package AppBundle\Util
 */
class MatrixGenerator
{
    public function create(array $numbers)
    {
        $matrix = array_fill(0, count($numbers) + 1, array_fill(0, count($numbers) + 1, 0));

        foreach ($numbers as $row => $valueX) {
            $matrix[$row + 1][0] = $valueX;
            foreach ($numbers as $col => $valueY) {
                $matrix[0][$col + 1] = $valueY;
                $matrix[$col + 1][$row + 1] = $valueX * $valueY;
            }
        }

        return $matrix;
    }
}
