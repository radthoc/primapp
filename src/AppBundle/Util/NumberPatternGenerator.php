<?php

namespace AppBundle\Util;

/**
 * Class NumberPatternGenerator
 * @package AppBundle\Util
 */
class NumberPatternGenerator
{
    const DEFAULT_PRIME_NUMBERS = 10;
    const PATTERN_HANDLER_SUFFIX = 'NumberHandler';

    /**
     * @param $pattern
     * @param int $numbers
     * @return array
     * @throws \Exception
     */
    public function getPrimeNumbers($pattern, $numbers = self::DEFAULT_PRIME_NUMBERS)
    {
        $number = 1;
        $primeNumbers = [];

        $patternHandler = $this->getPatternHandler($pattern);

        while (count($primeNumbers) < $numbers) {
            if ($patternHandler->isInPattern($number)) {
                $primeNumbers[] = $number;
            }
            $number++;
        }

        return $primeNumbers;
    }

    /**
     * @param $pattern
     * @return mixed
     * @throws \Exception
     */
    private function getPatternHandler($pattern)
    {
        $patternHandlerName = $this->getClassName($pattern);

        if (class_exists($patternHandlerName, true)) {
            $patternHandler = new $patternHandlerName();
            if ($patternHandler instanceof NumberPatternHandlerInterface) {
                return $patternHandler;
            }
        }

        throw new \Exception('Invalid pattern');
    }

    /**
     * @param $pattern
     * @return string
     */
    private function getClassName($pattern)
    {
        return __NAMESPACE__ .
            '\\' .
            ucfirst(strtolower($pattern)) .
            self::PATTERN_HANDLER_SUFFIX;
    }
}
