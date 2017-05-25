<?php

namespace AppBundle\Service;

/**
 * Class PrimeNumberService
 * @package AppBundle\Util
 */
class PrimeNumberService implements NumberPatternHandlerInterface
{
    /**
     * @param $number
     * @return bool
     */
    public function isInPattern($number)
    {
        return !preg_match('/^1?$|^(11+?)\1+$/x', str_repeat('1', $number));
    }
}
