<?php

namespace app\services;
class Autoload
{
    public function loadClass($className)
    {
        $file = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] . '/../'
            . mb_substr($className, 4) . '.php');
        if (file_exists($file)) {
            include $file;
        }

    }
}