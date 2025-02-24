<?php

declare(strict_types=1);

namespace Bridget\Concretes;

interface PathParser
{
    /**
     * Parse the parser path
     *
     * @return namespace\PathParsed
     */
    public function parse(): PathParsed;
}
