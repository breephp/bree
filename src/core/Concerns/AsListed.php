<?php

declare(strict_types=1);

namespace Bree\Concerns;

trait AsListed
{
    protected array $list = [];

    public function setList(array $list): static
    {
        foreach ($list as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    public function addItem(mixed $item): static
    {
        if (! in_array($item, $this->list)) {
            $this->list[] = $item;
        }

        return $this;
    }

    public function getItem(int $index): mixed
    {
        return $this->list[$index] ?? null;
    }

    public function getList(): array
    {
        return $this->list;
    }
}
