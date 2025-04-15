<?php

declare(strict_types=1);

namespace Bree\Concretes;

class UrlParsable implements UrlParser
{
    /**
     * Create a new parsable URL
     *
     * @param  string  $url  The url to parse
     */
    public function __construct(protected string $url) {}

    /**
     * Parse the url
     *
     * @param  string  $url  The url to parse
     * @param  int  $flags  Parsing flags
     * @return namespace\UrlParsed
     */
    public function parse(int $flags = -1): UrlParsed
    {
        $data = parse_url($this->url, $flags);

        switch ($flags) {
            case PHP_URL_SCHEME:
                $data = ['scheme' => $data];
                break;

            case PHP_URL_USER:
                $data = ['user' => $data];
                break;

            case PHP_URL_PASS:
                $data = ['pass' => $data];
                break;

            case PHP_URL_HOST:
                $data = ['host' => $data];
                break;

            case PHP_URL_PORT:
                $data = ['port' => $data];
                break;

            case PHP_URL_PATH:
                $data = ['path' => $data];
                break;

            case PHP_URL_QUERY:
                $data = ['query' => $data];
                break;

            case PHP_URL_FRAGMENT:
                $data = ['query' => $data];
                break;
        }

        return new UrlParsed($data);
    }
}
