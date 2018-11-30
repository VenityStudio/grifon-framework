<?php

namespace grifon\core\property;

use grifon\core\EventTrait;

class ArrayProperty extends AbstractProperty
{
    use EventTrait;

    /**
     * @var array
     */
    private $array;

    /**
     * ArrayProperty constructor.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->array = (array) $data;
    }

    /**
     * callable (array $oldValue, array $newValue)
     *
     * @param callable $callback
     * @return mixed
     */
    public function addListener(callable $callback): void {
        $this->bind("array-listener", $callback);
    }

    /**
     * @return array
     */
    public function getValue(): array {
        return $this->array;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function setValue($value): void{
        $old = $this->array;
        $this->trigger("array-listener", $old, $this->array = (array) $value);
    }
}