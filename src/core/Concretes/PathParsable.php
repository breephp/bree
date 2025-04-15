<?php

declare(strict_types=1);

namespace Bree\Concretes;

class PathParsable implements PathParser
{
    /**
     * Create a new parsable path
     *
     * @param  string  $path  The path to parse
     */
    public function __construct(protected string $path) {}

    /**
     * Parse the path
     *
     * @param  string  $path  The path to parse
     * @param  int  $flags  Parsing flags
     * @return namespace\PathParsed
     */
    public function parse(int $flags = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME): PathParsed
    {
        $data = pathinfo($this->path, $flags);

        switch ($flags) {
            case PATHINFO_DIRNAME:
                $data = ['dirname' => $data];
                break;

            case PATHINFO_BASENAME:
                $data = ['basename' => $data];
                break;

            case PATHINFO_EXTENSION:
                $data = ['extension' => $data];
                break;

            case PATHINFO_FILENAME:
                $data = ['filename' => $data];
                break;
        }

        return new PathParsed($data);
    }
}
