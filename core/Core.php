<?php
namespace core;
use core\Route as Route;
class Core
{
    public static $classMap = array();
    public static function run()
    {
        $route = new Route();
        // p($route);
        $ctl = $route->controller;
        $class = $route->fullClass;
        $method = $route->method;
        $file = $route->directory . $route->controller . '.php';   #控制器文件

        if(!file_exists($file))
            exit('控制器文件 ' . $file .' 未找到');
        require_once($file);
        $obj = (new $class);
        $obj->$method();
    }

    public static function autoload($class)
    {
        if(isset($classMap[$class]))
            return $classMap[$class];

        $file = BASEPATH . '/' . str_replace('\\', '/', $class) . '.php';

        if(file_exists($file)){
            self::$classMap[$class] = $file;
            require_once($file);
        }
        else {
            p("class $class not found in {$file}");
            exit();
        }
    }

    public function v($path, $data = array())
    {
        $file = APP . '/views/' . $path . '.php';
        if(file_exists($file)){
            extract($data);
            require($file);
        }
    }
}
