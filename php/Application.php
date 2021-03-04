<?php

class Application
{
    public static function init()
    {
        spl_autoload_register([__CLASS__, "loadModel"]);
        spl_autoload_register([__CLASS__, "loadClass"]);
    }

    public static function loadModel($className)
    {
        $filename = "./php/model/" . $className . ".php";
        if (is_readable($filename)) {
            require $filename;
        }
    }

    public static function loadClass($className)
    {
        $filename = "./php/" . $className . ".php";
        if (is_readable($filename)) {
            require $filename;
        }
    }
}
