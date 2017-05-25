<?php

namespace AppBundle\Service;

/**
 * Class PatternHandlerProvider
 * @package AppBundle\Tests\Util
 */
class PatternHandlerProvider
{

    const PATTERN_HANDLER_SUFFIX = 'NumberService';

    /**
     * @param $pattern
     * @return NumberPatternHandlerInterface
     * @throws \Exception
     */
    public function getPatternHandler($pattern)
    {
        $patternHandlerName = $this->getClassName($pattern);

        if (class_exists($patternHandlerName, true)) {
            return new $patternHandlerName();
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
