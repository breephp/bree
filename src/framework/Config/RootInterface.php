<?php

declare(strict_types=1);

namespace Bree\Config;

interface RootInterface
{
    /**
     * Get the loader root directory
     *
     * @return string The loader root directory
     */
    public function getRoot(): string;

    /**
     * Set the loader root directory
     *
     * @param  string  $root  The new loader root
     * @return static The static loader
     */
    public function setRoot(string $root): static;
}
