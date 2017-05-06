<?php

namespace AppBundle\Util;

/**
 * Class NumberPatternGenerator
 * @package AppBundle\Util
 */
class NumberPatternGenerator
{
    const DEFAULT_PATTERN_LENGTH = 10;
    const DEFAULT_PATTERN = 'prime';
    const PATTERN_HANDLER_SUFFIX = 'NumberHandler';

    /**
     * @param $pattern
     * @param int $length
     * @return array
     * @throws \Exception
     */
    public function getNumbers($pattern = self::DEFAULT_PATTERN, $length = self::DEFAULT_PATTERN_LENGTH)
    {
        $number = 1;
        $numbers = [];

        $patternHandler = $this->getPatternHandler($pattern);

        while (count($numbers) < $length) {
            if ($patternHandler->isInPattern($number)) {
                $numbers[] = $number;
            }
            $number++;
        }

        return $numbers;
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
