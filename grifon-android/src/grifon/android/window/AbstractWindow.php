<?php

namespace grifon\android\window;

use php\android\app\Activity;
use php\android\view\View;
use php\android\widget\Toast;

abstract class AbstractWindow
{
    /**
     * @var Activity
     */
    public $__activity;

    /**
     * @return string
     */
    abstract public function getTitle(): string;

    abstract public function init(): void;

    /**
     * @return View
     */
    abstract public function makeUI(): View;

    /**
     * @param string $massage
     * @param int $guardian
     */
    public function toast(string $massage, int $guardian = null) {
        Toast::make($massage, $guardian)->show();
    }
}