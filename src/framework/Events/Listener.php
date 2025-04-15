<?php

declare(strict_types=1);

namespace Bree\Events;

trait Listener
{
    /**
     * Listen an event
     *
     * @param  string  $event  The event name
     * @param  callable  $action  The event name
     */
    public function on(string $event, callable $action)
    {
        if (method_exists($this, $on = 'on'.ucfirst($event))) {
            return $this->$on($action);
        }
        throw new Error("Cannot listen \"$event\" on ".$this::class, Error::LISTENING);
    }
}
