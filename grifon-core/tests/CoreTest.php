<?php

use tester\Assert;
use tester\TestCase;

use grifon\core\property\IntegerProperty;
use grifon\core\property\StringProperty;
use grifon\core\property\BooleanProperty;

class CoreTest extends TestCase
{
    public function testProperty()
    {
        // int
        $int = new IntegerProperty(48);
        $int->addListener(function(int $old, int $new) { echo "old int: ", $old, " new int: ", $new, "\n"; });
        $int->setValue(56);

	    // bool
        $bool = new BooleanProperty(false);
        $bool->addListener(function(bool $old, bool $new) { echo "old bool: ", $old == true ? "true": "false", " new bool: ", $new == true ? "true": "false", "\n"; });
        $bool->setValue(true);

        // string
        $str = new StringProperty("test!");
        $str->addListener(function(string $old, string $new) { echo "old string: ", $old, " new string: ", $new, "\n"; });
        $str->setValue("Grifon");

        Assert::isEqual(56, $int->getValue());
        Assert::isEqual(true, $bool->getValue());
        Assert::isEqual("Grifon", $str->getValue());
    }
}