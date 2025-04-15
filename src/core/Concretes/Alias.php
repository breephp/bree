<?php

declare(strict_types=1);

namespace Bree\Concretes;

use Bree\Concerns\AsNamed;
use Bree\Contracts\IsNamed;

class Alias implements IsNamed
{
    use AsNamed;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}
