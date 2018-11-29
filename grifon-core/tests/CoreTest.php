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
        $int->setListener(function(int $old, int $new) { echo "old int: ", $old, " new int: ", $new, "\n"; });
        $int->setValue(56);
        Assert::isEqual(56, $int->getValue());

	    // bool
        $bool = new BooleanProperty(false);
        $bool->setListener(function(bool $old, bool $new) { echo "old bool: ", $old == true ? "true": "false", " new bool: ", $new == true ? "true": "false", "\n"; });
        $bool->setValue(true);
        Assert::isEqual(true, $bool->getValue());

        // string
        $str = new StringProperty("test!");
        $str->setListener(function(string $old, string $new) { echo "old string: ", $old, " new string: ", $new, "\n"; });
        $str->setValue("Grifon");
        Assert::isEqual("Grifon", $str->getValue());
    }
}