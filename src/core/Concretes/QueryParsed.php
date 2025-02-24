<?php

declare(strict_types=1);

namespace Bridget\Concretes;

class QueryParsed
{
    /**
     * Create a new parsed query
     *
     * @param  array  $data  The query parsed data
     */
    public function __construct(protected array $data) {}

    /**
     * Give the query data
     *
     * @param  array  $data  The query parsed data
     * @param  null|string  $name  The data index
     * @return mixed
     */
    public function data(?string $name = null)
    {
        return isset($name) ? ($this->data[$name] ?? null) : $this->data;
    }

    /**
     * Give the query data value by index
     *
     * @param  string  $name  The data index
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data($name);
    }
}
