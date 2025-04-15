<?php

declare(strict_types=1);

namespace Bree\Concretes;

class Tokenizer
{
    public function tokenize(string $source): array
    {
        return $this->tokenizePhp($source);
    }

    public function tokenizePhp(string $source): array
    {
        $tokens = [];

        foreach (token_get_all($source) as $token) {
            $name = isset($token[1]) ? token_name($token[0]) : $token[0];
            $value = $token[1] ?? $token[0];
            $tokens[] = new Token($name, $value);
        }

        return $tokens;
    }
}
