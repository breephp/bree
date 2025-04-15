<?php

declare(strict_types=1);

namespace Bree\Foundation\Cli;

class Program
{
    protected array $commands = [];

    public function __construct(protected string $name = '', protected string $version = '') {}

    public function addCommand(string $name, string $description, string $signature): static
    {
        return $this->add(new Command($name, $signature, $description));
    }

    public function add(Command $command): static
    {
        $this->commands[] = $command;

        return $this;
    }
}
