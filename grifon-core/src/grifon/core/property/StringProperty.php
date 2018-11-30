<?php

namespace grifon\core\property;

use grifon\core\EventTrait;

class StringProperty extends AbstractProperty
{
    use EventTrait;

    /**
     * @var string
     */
    protected $string;

    /**
     * StringProperty constructor.
     *
     * @param string $data
     */
    public function __construct($data) {
        $this->string = (string) $data;
    }

    /**
     * callable (string $oldValue, string $newValue)
     *
     * @param callable $callback
     * @return void
     */
    public function addListener(callable $callback): void {
        $this->bind("string-listener", $callback);
    }

    /**
     * @return string
     */
    public function getValue(): string {
        return $this->string;
    }

    /**
     * @param $value
     * @return void
     */
    public function setValue($value): void {
        $old = $this->string;
        $this->trigger("string-listener", $old, $this->string = (string) $value);
    }
}