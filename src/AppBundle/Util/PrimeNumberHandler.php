<?php

namespace AppBundle\Util;

/**
 * Class PrimeNumberHandler
 * @package AppBundle\Util
 */
class PrimeNumberHandler implements NumberPatternHandlerInterface
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
