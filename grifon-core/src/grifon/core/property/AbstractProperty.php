<?php

namespace grifon\core\property;

abstract class AbstractProperty
{
    /**
     * AbstractProperty constructor.
     *
     * @param $data
     */
    abstract public function __construct($data);

    /**
     * @param callable $callback
     * @return mixed
     */
    abstract public function addListener(callable $callback) : void;

    /**
     * @return mixed
     */
    abstract public function getValue();

    /**
     * @param mixed $value
     * @return void
     */
    abstract public function setValue($value) : void;
}