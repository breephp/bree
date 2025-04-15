<?php

declare(strict_types=1);

namespace Bree\Events;

interface Listenable
{
    /**
     * Listen an event
     *
     * @param  string  $event  The event name
     * @param  callable  $action  The event name
     */
    public function on(string $event, callable $action);
}
