<?php

namespace AppBundle\Util;

/**
 *
 * User: radt
 */
class PrimeNumbers
{
    const DEFAULT_PRIME_NUMBERS = 10;
    public function getPrimeNumbers($numbers = self::DEFAULT_PRIME_NUMBERS)
    {
        $number = 1;
        $primeNumbers = [];

        while (count($primeNumbers) < $numbers) {
            if ($this->isPrime($number)) {
                $primeNumbers[] = $number;
            }
            $number++;
        }

        return $primeNumbers;
    }

    public function isPrime($number)
    {
        return !preg_match('/^1?$|^(11+?)\1+$/x', str_repeat('1', $number));
    }
}