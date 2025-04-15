<?php

declare(strict_types=1);

namespace Bree\Concretes;

interface QueryParser
{
    /**
     * Parse the parser query
     *
     * @return namespace\QueryParsed
     */
    public function parse(): QueryParsed;
}
