<?php

class Application
{
    private static $context;

    public static function init()
    {
        spl_autoload_register([__CLASS__, "loadModel"]);
        spl_autoload_register([__CLASS__, "loadClass"]);

        session_start();
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

    public static function context()
    {
        if (!isset(self::$context)) {
            self::$context = new DatabaseContext();
        }

        return self::$context;
    }

    public static function login($user)
    {
        unset($user["password"]);
        $_SESSION["user"] = $user;
        session_regenerate_id();
    }

    public static function logout()
    {
        session_destroy();
    }

    public static function logged_in()
    {
        if(isset($_SESSION["user"])) {
            $user = self::context()->user_repository->getUser($_SESSION["user"]["id"]);

            if(empty($user)) {
                self::logout();
                return false;
            }

            self::login($user);
            return true;
        }

        return false;
    }

    public static function user()
    {
        return $_SESSION["user"];
    }

    public static function admin()
    {
        return $_SESSION["user"]["admin"];
    }

    public static function assert_logged_in($redirect_address = "index.php")
    {
        if (!self::logged_in()) {
            header("Location: $redirect_address");
            die();
        }
    }
}
