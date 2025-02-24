<?php

declare(strict_types=1);

namespace Bridget\Concretes;

interface Statement
{
    public static function parse(mixed $value): self;
}
