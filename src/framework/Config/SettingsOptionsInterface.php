<?php

declare(strict_types=1);

namespace Bree\Config;

interface SettingsOptionsInterface
{
    /**
     * Set options list
     *
     * @param  array  $options  Options list
     */
    public function setOptions(array $options, string $delimiter = '.'): self;

    /**
     * Set an option
     *
     * @param  string|int  $key  The option key
     * @param  mixed  $value  The option value
     */
    public function setOption(string|int $key, mixed $value): self;

    /**
     * Set a group of options
     *
     * @param  string  $key  The group key
     * @param  mixed  $value  The option value
     */
    public function setGroup(string $key, mixed $value, string $delimiter): self;

    /**
     * Get an option

     *
     * @param  string|int  $key  The option key
     * @return mixed The option value
     */
    public function getOption(string|int $key): mixed;

    /**
     * Check if an option exists
     *
     * @param  string|int  $key  The option key
     * @return bool The option exists
     */
    public function issetOption(string|int $key): bool;

    /**
     * Unset an option
     *
     * @param  string|int  $key  The option key
     */
    public function unsetOption(string|int $key): void;

    /**
     * Get options list
     *
     * @return array Options list
     */
    public function getOptions(): array;
}
