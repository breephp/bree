<?php

declare(strict_types=1);

namespace Bree\Config;

trait SettingsOptionsTrait
{
    /**
     * @var array Options list
     */
    protected array $options = [];

    /**
     * Set options list
     *
     * @param  array  $options  Options list
     */
    public function setOptions(array $options, string $delimiter = '.'): self
    {

        foreach ($options as $key => $value) {
            is_int(strpos($key, $delimiter)) ?
              $this->setGroup($key, $value, $delimiter) :
              $this->setOption($key, $value);
        }

        return $this;
    }

    /**
     * Set an option
     *
     * @param  string|int  $key  The option key
     * @param  mixed  $value  The option value
     */
    public function setOption(string|int $key, mixed $value): self
    {

        if (is_array($value)) {
            $value = new Settings($value);
        }
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * Set a group of options
     *
     * @param  string  $key  The group key
     * @param  mixed  $value  The option value
     */
    public function setGroup(string $key, mixed $value, string $delimiter): self
    {

        $keys = explode($delimiter, $key);
        if (count($keys) <= 1) {
            return $this->setOption($key, $value);
        }

        $key = $keys[0];
        if (! isset($this->options[$key])) {
            $this->options[$key] = [];
        }

        $group = &$this->options[$key];
        if (is_array($group)) {
            $group = new Settings($group);
        } elseif (! is_object($group) || ! ($group instanceof Settings)) {
            throw new \RuntimeException("Cannot use $key as group");
        }

        unset($keys[0]);
        $key = implode('.', $keys);

        return $group->setOption($key, $value);
    }

    /**
     * Get an option

     *
     * @param  string|int  $key  The option key
     * @return mixed The option value
     */
    public function getOption(string|int $key): mixed
    {

        return $this->options[$key] ?? null;
    }

    /**
     * Check if an option exists
     *
     * @param  string|int  $key  The option key
     * @return bool The option exists
     */
    public function issetOption(string|int $key): bool
    {

        return isset($this->options[$key]);
    }

    /**
     * Unset an option
     *
     * @param  string|int  $key  The option key
     */
    public function unsetOption(string|int $key): void
    {

        unset($this->options[$key]);
    }

    /**
     * Get options list
     *
     * @return array Options list
     */
    public function getOptions(): array
    {

        return $this->options;
    }
}
