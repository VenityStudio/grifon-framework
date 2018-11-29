<?php

namespace grifon\core;


trait EventTrait
{
    /**
     * @var callable[]
     */
    private $events;

    /**
     * Bind event
     *
     * @param string $event
     * @param callable $callback
     */
    protected function on(string $event, callable $callback) : void {
        $this->events[$event] = $callback;
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
    protected function trigger(string $event, ... $data) : void {
        if (is_callable($this->events[$event])) call_user_func_array($this->events[$event], $data);
    }
}