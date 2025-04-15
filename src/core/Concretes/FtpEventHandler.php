<?php

declare(strict_types=1);

namespace Bree\Concretes;

interface FtpEventHandler
{
    public function todo(): array;

    public function on(string $event, callable $eventListener): self;

    public function undo(string $event, ?callable $eventListener = null): self;

    public function do(string $event, mixed ...$data): self;

    public function done(?string $event = null): array;

    public function to(FtpEventHandler $eventEmitter): self;
}
