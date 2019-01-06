<?php

namespace grifon\android\utils;

use grifon\android\Application;
use php\io\File;

class FileUtils
{
    /**
     * @param string $path
     * @return File
     */
    public static function getFile(string $path): File {
        return new File(Application::get()->getRootDirectory(), $path);
    }
}