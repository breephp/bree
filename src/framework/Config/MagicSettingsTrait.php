<?php

declare(strict_types=1);

namespace Bree\Config;

trait MagicSettingsTrait
{
    use SettingsOptionsTrait;

    public function __get(string $key): mixed
    {
        return $this->getOption($key);
    }

    public function __set(string $key, mixed $value): void
    {
        $this->setOption($key, $value);
    }

    public function __isset(string $key): bool
    {
        return $this->issetOption($key);
    }

    public function __unset(string $key): void
    {
        $this->unsetOption($key);
    }
}
