<?php

declare(strict_types=1);

namespace Bridget\Support;

class Regexp
{
    protected array $matches = [];

    public function __construct(readonly string $pattern) {}

    public function match(string $subject): bool
    {
        return preg_match($this->pattern, $subject, $this->matches) === 1;
    }

    public function getMatches(): array
    {
        return $this->matches;
    }
}
