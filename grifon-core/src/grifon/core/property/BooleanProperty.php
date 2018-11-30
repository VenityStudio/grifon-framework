<?php

namespace grifon\core\property;

use grifon\core\EventTrait;

class BooleanProperty extends AbstractProperty
{
    use EventTrait;

    /**
     * @var boolean
     */
    private $boolean;

    /**
     * BooleanProperty constructor.
     *
     * @param boolean $data
     */
    public function __construct($data) {
        $this->boolean = (bool) $data;
    }

    /**
     * callable (bool $oldValue, bool $newValue)
     *
     * @param callable $callback
     * @return void
     */
    public function addListener(callable $callback): void {
        $this->on("boolean-listener", $callback);
    }

    /**
     * @return boolean
     */
    public function getValue(): bool {
        return $this->boolean;
    }

    /**
     * @param boolean $value
     * @return void
     */
    public function setValue($value): void {
        $old = $this->boolean;
        $this->trigger("boolean-listener", $old, $this->boolean = (bool) $value);
    }
}