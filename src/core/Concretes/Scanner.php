<?php

declare(strict_types=1);

namespace Bree\Concretes;

class Scanner
{
    private array $tokens;

    private int $position = 0;

    public function __construct(array $tokens)
    {
        $this->tokens = array_values($tokens); // Réindexe les clés numériques
    }

    public function current(): mixed
    {
        return $this->tokens[$this->position] ?? null;
    }

    public function peek(int $offset = 1): mixed
    {
        $index = $this->position + $offset;

        return $this->tokens[$index] ?? null;
    }

    public function prev(int $offset = 1): mixed
    {
        return $this->peek(-$offset);
    }

    public function next(): mixed
    {
        $this->position = min($this->position + 1, count($this->tokens) - 1);

        return $this->current();
    }

    public function back(): mixed
    {
        $this->position = max($this->position - 1, 0);

        return $this->current();
    }

    public function seek(int $offset): mixed
    {
        $this->position = max(0, min($this->position + $offset, count($this->tokens) - 1));

        return $this->current();
    }

    public function reset(): void
    {
        $this->position = 0;
    }

    public function isEOF(): bool
    {
        return $this->position >= count($this->tokens);
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $pos): void
    {
        $this->position = max(0, min($pos, count($this->tokens) - 1));
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }
}
