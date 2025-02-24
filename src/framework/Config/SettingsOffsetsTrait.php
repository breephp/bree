<?php

declare(strict_types=1);

namespace Bridget\Config;

trait SettingsOffsetsTrait
{
    use SettingsOptionsTrait;

    public function offsetExists(mixed $offset): bool
    {
        return $this->issetOption($offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->getOption($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->setOption($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->unsetOption($offset);
    }
}
