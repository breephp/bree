<?php

declare(strict_types=1);

namespace Bridget\Concerns;

use Bridget\Types\ScalarType;

trait AsNumeric
{
    use AsScalar;

    public function __invoke(mixed $value = null): int|float|string
    {
        if ($value !== null) {
            return static::of($value)->get();
        }

        return $this->get();
    }

    abstract public function get(): int|float|string;

    /**
     * @throws \InvalidArgumentException If the value is not numeric.
     */
    public static function of(mixed $value): self
    {
        if ($value instanceof static) {
            return $value;
        }

        if ($value instanceof ScalarType) {
            $value = (string) $value->get();
        }

        if (is_numeric($value)) {
            return new self($value);
        }

        throw new \InvalidArgumentException(sprintf(
            'Value "%s" is not numeric.',
            get_debug_type($value),
        ));
    }
}
