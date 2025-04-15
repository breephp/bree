<?php

declare(strict_types=1);

namespace Bree\Samples;

use Bree\Contracts\IsEncapsulated;

interface CustomInterface extends IsEncapsulated
{
    public function getName(): string;

    public function setName(string $name): static;
}
