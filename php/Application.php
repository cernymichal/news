<?php

class Application
{
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

    public static function login_session($user)
    {
        unset($user["password"]);
        $_SESSION["user"] = $user;
        session_regenerate_id();
    }

    public static function logged_in() {
        $ur = new UserRepository(new Database());
        return isset($_SESSION["user"]) && !empty($ur->getUser($_SESSION["user"]["id"]));
    }

    public static function logged_user() {
        return $_SESSION["user"];
    }

    public static function assert_logged_in($redirect_address = "index.php") {
        if(!self::logged_in()) {
            header("Location: $redirect_address");
            die();
        }
    }
}
