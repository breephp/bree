<?php

declare(strict_types=1);

namespace Bridget\Concerns;

use Bridget\Types\NumericType;

trait AsNumber
{
    use AsNumeric;

    public function __invoke(mixed $value = null): int|float
    {
        if ($value !== null) {
            return static::of($value)->get();
        }

        return $this->get();
    }

    abstract public function get(): int|float;

    /**
     * @throws \InvalidArgumentException If the value is not a number.
     */
    public static function of(mixed $value): self
    {
        if ($value instanceof static) {
            return $value;
        }

        if ($value instanceof NumericType) {
            $value = str_contains((string) $value->get(), '.') ? (float) $value->get() : (int) $value->get();
        }

        if (is_int($value) || is_float($value)) {
            return new self($value);
        }

        throw new \InvalidArgumentException(sprintf(
            'Value "%s" is not a number.',
            get_debug_type($value),
        ));
    }
}
