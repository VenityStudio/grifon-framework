<?php

namespace grifon\core\property;

use grifon\core\EventTrait;

class IntegerProperty extends AbstractProperty
{
    use EventTrait;

    /**
     * @var integer
     */
    private $integer;

    /**
     * IntegerProperty constructor.
     *
     * @param integer $data
     */
    public function __construct($data) {
        $this->integer = (int) $data;
    }

    /**
     * callable (int $oldValue, int $newValue)
     *
     * @param callable $callback
     * @return void
     */
    public function addListener(callable $callback): void {
        $this->on("integer-listener", $callback);
    }

    /**
     * @return int
     */
    public function getValue(): int {
        return $this->integer;
    }

    /**
     * @param int $value
     * @return void
     */
    public function setValue($value): void {
        $old = $this->integer;
        $this->trigger("integer-listener", $old, $this->integer = (int) $value);
    }
}