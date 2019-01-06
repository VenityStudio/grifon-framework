<?php

namespace grifon\android;

use grifon\android\window\AbstractWindow;
use grifon\l10n\L10N;
use php\android\app\Activity;
use php\io\File;

class Application
{
    /**
     * @var Application
     */
    private static $INSTANCE;

    /**
     * @var AbstractWindow
     */
    private $currentWindow;

    public function __construct(AbstractWindow $mainWindow)
    {
        if (static::$INSTANCE != null) throw new \Exception("Android Application already created");

        static::$INSTANCE = $this;
        $this->currentWindow = $mainWindow;

        \php\android\app\Application::setMainActivityHandler([$this, "mainActivityHandler"]);
    }

    /**
     * @return Application
     */
    public static function get() {
        return static::$INSTANCE;
    }

    /**
     * @param AbstractWindow $window
     */
    public function showWindow(AbstractWindow $window) {
        $this->currentWindow = $window;
        $this->mainActivityHandler();
    }

    /**
     * @return File
     */
    public function getRootDirectory(): File {
        return \php\android\app\Application::getFilesDir();
    }

    protected function mainActivityHandler() {
        $activity = \php\android\app\Application::getMainActivity();
        $this->currentWindow->__activity = $activity;
        $this->currentWindow->init();
        $activity->setTitle($this->currentWindow->getTitle());

        if ($mainView = $this->currentWindow->makeUI())
            $activity->setContentView($mainView);
    }
}