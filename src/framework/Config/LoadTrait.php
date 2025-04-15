<?php

declare(strict_types=1);

namespace Bree\Config;

trait LoadTrait
{
    /**
     * Load a configuration file
     *
     * @param  string  $file  The file to load
     * @return Settings The configuration options
     *
     * @throws namespace\Error If the file is invalid
     */
    public function load(string $file): SettingsInterface
    {

        if (empty($file)) {
            throw new Error('Empty file name given', Error::INVALID_FILE);
        }

        if (! is_file($path = $this->root."$file.php")) {
            throw new Error("No such file $file in $this->root");
        }

        if (! is_readable($path)) {
            throw new Error("Cannot read file $path");
        }

        $options = require $path;
        if (! is_array($options)) {
            throw new Error("The $path file must return an array", Error::INVALID_FILE);
        }

        return new Settings($options);
    }
}
