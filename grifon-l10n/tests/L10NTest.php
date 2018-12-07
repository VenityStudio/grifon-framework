<?php

use tester\Assert;
use tester\TestCase;

use grifon\l10n\L10N;

class L10NTest extends TestCase
{
    /**
     * @throws \php\format\ProcessorException
     * @throws \php\io\IOException
     */
    public function testPut() {

        // from words
        L10N::getInstance()->putWord("en", "grifon.l10n", "Grifon localization");
        L10N::getInstance()->putWord("ru", "grifon.l10n", "Grifon локализатор");
        L10N::getInstance()->putWord("jp", "grifon.l10n", "Grifon ローカライザ");

        // from files
        L10N::loadFromFile("en", "res://support/en.yml");
        L10N::loadFromFile("ru", "res://support/ru.yml");
        L10N::loadFromFile("jp", "res://support/jp.yml");
    }

    public function testGet() {

        // english
        L10N::getInstance()->setDefaultLang("en");
        Assert::isEqual(L10N::getInstance()->get("grifon.l10n")->getValue(), "Grifon localization");
        Assert::isEqual(L10N::getInstance()->get("grifon.test")->getValue(), "Testing");

        // russian
        L10N::getInstance()->setDefaultLang("ru");
        Assert::isEqual(L10N::getInstance()->get("grifon.l10n")->getValue(), "Grifon локализатор");
        Assert::isEqual(L10N::getInstance()->get("grifon.test")->getValue(), "Тестирование");

        // japan
        L10N::getInstance()->setDefaultLang("jp");
        Assert::isEqual(L10N::getInstance()->get("grifon.l10n")->getValue(), "Grifon ローカライザ");
        Assert::isEqual(L10N::getInstance()->get("grifon.test")->getValue(), "テスト");
    }
}