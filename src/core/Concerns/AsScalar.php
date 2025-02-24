<?php

declare(strict_types=1);

namespace Bridget\Concerns;

use Bridget\Types\MixedType;

trait AsScalar
{
    use AsMixed;

    public function __toString(): string
    {
        /** @psalm-suppress RedundantCast */
        return (string) $this->get();
    }

    public function __invoke(mixed $value = null): bool|int|float|string
    {
        if ($value !== null) {
            return static::of($value)->get();
        }

        return $this->get();
    }

    abstract public function get(): bool|int|float|string;

    /**
     * @throws \InvalidArgumentException If the value is not a scalar.
     */
    public static function of(mixed $value): self
    {
        if ($value instanceof static) {
            return $value;
        }

        if ($value instanceof MixedType) {
            /** @var mixed $value */
            $value = $value->get();
        }

        if (is_scalar($value)) {
            return new self($value);
        }

        throw new \InvalidArgumentException(sprintf(
            'Value "%s" is not a scalar.',
            get_debug_type($value),
        ));
    }
}
