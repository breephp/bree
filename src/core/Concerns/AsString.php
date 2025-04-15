<?php

declare(strict_types=1);

namespace Bree\Concerns;

use Bree\Types\ScalarType;

trait AsString
{
    use AsScalar;

    public function __invoke(mixed $value = null): string
    {
        if ($value !== null) {
            return static::of($value)->get();
        }

        return $this->get();
    }

    /**
     * @throws \InvalidArgumentException If the value is not a string.
     */
    public static function of(mixed $value): self
    {
        if ($value instanceof static) {
            return $value;
        }

        if ($value instanceof ScalarType) {
            $value = (string) $value->get();
        }

        if (is_string($value)) {
            return new self($value);
        }

        throw new \InvalidArgumentException(sprintf(
            'Value "%s" is not a string.',
            get_debug_type($value),
        ));
    }
}
