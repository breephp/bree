<?php

declare(strict_types=1);

namespace Bridget\Concerns;

use Bridget\Types\ScalarType;

trait AsBool
{
    use AsScalar;

    public function __invoke(mixed $value = null): bool
    {
        if ($value !== null) {
            return static::of($value)->get();
        }

        return $this->get();
    }

    abstract public function get(): bool;

    /**
     * @throws \InvalidArgumentException If the value is not a boolean.
     */
    public static function of(mixed $value): self
    {
        if ($value instanceof static) {
            return $value;
        }

        if ($value instanceof ScalarType) {
            $value = (bool) $value->get();
        }

        if (is_bool($value)) {
            return new self($value);
        }

        throw new \InvalidArgumentException(sprintf(
            'Value "%s" is not a boolean.',
            get_debug_type($value),
        ));
    }

    public function isTrue(): bool
    {
        return $this->get();
    }

    public function isFalse(): bool
    {
        return ! $this->get();
    }

    public function toTrue(): self
    {
        return static::of(true);
    }

    public function toFalse(): self
    {
        return static::of(false);
    }

    public static function isTruthy(bool $value): bool
    {
        return static::of($value)->isTrue();
    }

    public static function isFalsy(bool $value): bool
    {
        return static::of($value)->isFalse();
    }

    public static function truthify(mixed $value): self
    {
        return static::of($value)->toTrue();
    }

    public static function falsify(mixed $value): self
    {
        return static::of($value)->toFalse();
    }
}
