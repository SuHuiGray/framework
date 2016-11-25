<?php
namespace core;
class Config
{
    public static $config;
    public function __construct()
    {
        $file = APP . 'config/config.php';
        self::$config['base'] = require_once $file;
    }

    public static function load_config($name)
    {
        if(isset(self))
    }
}
