<?php

namespace grifon\core;


trait EventTrait
{
    /**
     * @var array
     */
    private $events;

    /**
     * Bind event
     *
     * @param string $event
     * @param callable $callback
     */
    protected function on(string $event, callable $callback) : void {
        $this->events[$event][] = $callback;
    }

    /**
     * Unbind event
     *
     * @param string $event
     */
    protected function off(string $event) : void {
        $this->events[$event] = null;
    }

    /**
     * Trigger event
     *
     * @param string $event
     * @param array $data
     */
    protected function trigger(string $eventName, ... $data) : void {
        if ($this->events[$eventName])
            foreach ($this->events[$eventName] as $event)
                if (is_callable($event)) call_user_func_array($event, $data);
    }
}