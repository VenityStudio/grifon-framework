<?php

namespace grifon\l10n;

use grifon\core\EventTrait;
use grifon\core\property\StringProperty;
use php\lang\System;
use php\lib\fs;

class L10N
{
    use EventTrait;

    /**
     * @var array
     */
    private static $words;

    /**
     * @var string
     */
    private static $defaultLang;

    /**
     * @var L10N
     */
    private static $instance;

    /**
     * L10N constructor
     */
    public function __construct() {
        if (!static::$instance) static::$instance = $this;
    }

    /**
     * @return L10N
     */
    public static function getInstance(): L10N
    {
        if (static::$instance) return self::$instance; else { // create instance and set default JVM language
            (new L10N())->setDefaultLang(System::getProperty("user.language", "en"));
            return self::getInstance();
        }
    }

    /**
     * @param string $lang
     * @param string $key
     * @param string $word
     */
    public function putWord(string $lang, string $key, string $word): void {
        static::$words[$lang][$key] = $word;
        $this->trigger("put-word", $lang, $key, $word);
    }

    /**
     * @param string $key
     * @return string
     */
    private function getString(string $key): string {
        return static::$words[static::$defaultLang][$key] ?: $key;
    }

    /**
     * @param string $key
     * @return StringProperty
     */
    public function get(string $key): StringProperty {
        $property = new StringProperty($this->getString($key));
        $this->bind("change-lang", function () use ($property, $key) {
            $property->setValue($this->getString($key));
        });

        return $property;
    }

    /**
     * @param string $lang
     */
    public function setDefaultLang(string $lang): void {
        static::$defaultLang = $lang;
        $this->trigger("change-lang");
    }

    /**
     * File type: YAML
     *
     * @param string $lang
     * @param string $file
     * @throws \php\format\ProcessorException
     * @throws \php\io\IOException
     */
    public static function loadFromFile(string $lang, string $file): void {
        foreach (fs::parseAs($file, "yaml") as $key => $word) L10N::getInstance()->putWord($lang, (string) $key, (string) $word);
    }
}