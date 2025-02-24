<?php

declare(strict_types=1);

namespace Bridget\Concretes;

class Map
{
    public function __construct(string $keys_type, string $values_type)
    {

        $keys_type = Filter::sanitize($keys_type);
        if (! Filter::validate($keys_type)) {
            throw new Error("Unknown type $keys_type", Error::INVALID_TYPE);
        }
        $this->keys_type = $keys_type;

        $values_type = Filter::sanitize($values_type);
        if (! Filter::validate($values_type)) {
            throw new Error("Unknown type $values_type", Error::INVALID_TYPE);
        }
        $this->values_type = $values_type;
    }

    protected int $count = 0;

    protected string $keys_type;

    protected array $keys_list = [];

    protected string $values_type;

    protected array $values_list = [];

    public function set(mixed $key, mixed $value): static
    {

        $key_type = Filter::sanitize(gettype($key));
        if ($key_type !== 'mixed' && $key_type !== $this->keys_type) {
            throw new Error("Invalid key type ($key_type) given", Error::INVALID_KEY);
        }

        $value_type = Filter::sanitize(gettype($value));
        if ($value_type !== 'mixed' && $value_type !== $this->values_type) {
            throw new Error("Invalid value type ($value_type) given", Error::INVALID_VALUE);
        }

        if (false === ($index = array_search($key, $this->keys_list, true))) {
            $index = $this->count++;
        }

        $this->keys_list[$index] = $key;
        $this->values_list[$index] = $value;

        return $this;
    }

    public function get(mixed $key): mixed
    {

        return false === ($index = array_search($key, $this->keys_list, true)) ? null : $this->values_list[$index];
    }

    public function has(mixed $key): bool
    {

        return in_array($key, $this->keys_list, true);
    }
}
