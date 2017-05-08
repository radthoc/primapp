<?php

namespace AppBundle\Util;

/**
 * Class PatternHandlerProvider
 * @package AppBundle\Tests\Util
 */
class PatternHandlerProvider
{

    const PATTERN_HANDLER_SUFFIX = 'NumberHandler';

    /**
     * @param $pattern
     * @return NumberPatternHandlerInterface
     * @throws \Exception
     */
    public function getPatternHandler($pattern)
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
