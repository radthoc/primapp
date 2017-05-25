<?php

namespace AppBundle\Service;

interface NumberPatternHandlerInterface {
    public function isInPattern($number);
}