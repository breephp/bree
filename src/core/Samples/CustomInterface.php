<?php

declare(strict_types=1);

namespace Bridget\Samples;

use Bridget\Contracts\IsEncapsulated;

interface CustomInterface extends IsEncapsulated
{
    public function getName(): string;

    public function setName(string $name): static;
}
