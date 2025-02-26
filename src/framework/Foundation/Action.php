<?php

declare(strict_types=1);

namespace Bridget\Foundation;

abstract class Action
{
    public function __construct(protected string $name) {}
}
