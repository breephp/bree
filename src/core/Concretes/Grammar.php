<?php

declare(strict_types=1);

namespace Bree\Concretes;

class Grammar
{
    public function __construct(string $rule)
    {
        $this->setRule($rule);
    }

    protected string $rule;

    public function setRule(string $rule): self
    {
        $this->rule = $this->parse_rule($rule);

        return $this;
    }

    public function getRule(): string
    {
        $rule = $this->format_rule($this->rule);

        return $rule;
    }

    protected function parse_rule(string $rule): array
    {
        $parsed_rule = [];

        // Parsing code...

        return $parsed_rule;
    }

    protected function format_rule(array $rule): string
    {
        $rule_formated = '';

        // Formatting code...

        return $rule_formated;
    }

    public function parse(string $code): array {}
}
