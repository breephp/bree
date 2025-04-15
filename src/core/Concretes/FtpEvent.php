<?php

declare(strict_types=1);

namespace Bree\Concretes;

trait FtpEvent
{
    protected array $eventEmitters = [];

    public function to(FtpEventHandler $eventEmitter): self
    {
        $this->eventEmitters[] = $eventEmitter;

        return $this;
    }

    protected array $eventListeners = [];

    public function todo(): array
    {
        return $this->eventListeners;
    }

    public function on(string $event, callable $eventListener): self
    {
        foreach ($this->eventEmitters as $eventEmitter) {
            $eventEmitter->on($event, $eventListener);
        }

        if (! isset($this->eventListeners[$event])) {
            $this->eventListeners[$event] = [];
        }
        $this->eventListeners[$event][] = $eventListener;

        return $this;
    }

    public function undo(string $event, ?callable $eventListener = null): self
    {
        foreach ($this->eventEmitters as $eventEmitter) {
            $eventEmitter->undo($event, $eventListener);
        }

        if (! isset($this->eventListeners[$event])) {
            return $this;
        }

        if (is_null($eventListener)) {
            unset($this->eventListeners[$event]);

            return $this;
        }

        if (false === ($key = array_search($eventListener, $this->eventListeners[$event]))) {
            return $this;
        }

        array_splice($this->eventListeners[$event], $key, 1);

        return $this;
    }

    protected array $eventsListened = [];

    public function do(string $event, mixed ...$data): self
    {
        foreach ($this->eventEmitters as $eventEmitter) {
            $eventEmitter->do($event, $eventListener);
        }

        if (! isset($this->eventListeners[$event])) {
            return $this;
        }

        foreach ($this->eventListeners[$event] as $key => $eventListener) {
            $this->eventsListened[$event][$key][] = $eventListener(...$data);
        }

        return $this;
    }

    public function done(?string $event = null): array
    {
        return $event ? ($this->eventsListened[$event] ?? []) : $this->eventsListened;
    }
}
