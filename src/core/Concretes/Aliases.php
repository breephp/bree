<?php

declare(strict_types=1);

namespace Bridget\Concretes;

use Bridget\Concerns\AsListed;
use Bridget\Contracts\IsListed;

class Aliases implements IsListed
{
    use AsListed {
        addItem as protected addListItem;
    }

    public function __construct(Alias|string ...$aliases)
    {
        $this->setList($aliases);
    }

    public function addItem(mixed $item): static
    {
        if (! $item instanceof Alias) {
            if (! is_string($item)) {
                throw new \InvalidArgumentException('Could not use '.get_debug_type($item).' as alias');
            }

            $item = new Alias($item);
        }

        return $this->addListItem($item);
    }
}
