<?php

declare(strict_types=1);

namespace Bridget\Concretes;

use Bridget\Concerns\AsNamed;
use Bridget\Contracts\IsNamed;

class Alias implements IsNamed
{
    use AsNamed;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
