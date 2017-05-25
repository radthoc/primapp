<?php

namespace AppBundle\Util;

use AppBundle\Service\NumberPatternHandlerInterface;
use AppBundle\Service\PatternHandlerProvider;

/**
 * Class NumberPatternGenerator
 * @package AppBundle\Util
 */
class NumberPatternGenerator
{
    const DEFAULT_PATTERN_LENGTH = 10;
    const DEFAULT_PATTERN = 'prime';

    /**
     *
     * @var PatternHandlerProvider
     */
    private $patternHandlerProvider;

    public function __construct(PatternHandlerProvider $patternHandlerProvider)
    {
        $this->patternHandlerProvider = $patternHandlerProvider;
    }

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
     * @return NumberPatternHandlerInterface
     * @throws \Exception
     */
    private function getPatternHandler($pattern)
    {
        $patternHandler = $this->patternHandlerProvider->getPatternHandler($pattern);
        if ($patternHandler instanceof NumberPatternHandlerInterface) {
            return $patternHandler;
        }

        throw new \Exception('Invalid pattern');
    }
}
