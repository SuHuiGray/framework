<?php
if(!function_exists("p")){
    function p($var)
    {
        if(is_bool($var)){
            var_dump($var);
        }
        else {
            echo '<pre><code style="display:block; padding:10px; width:96%; border:2px solid #aaa; border-radius:5px; background-color:#F5F5F5; font-size:14px; opacity:0.9">' . print_r($var, true) . '</code></pre>';
        }
    }
}

if(!function_exists("get_config")){
    function get_config($name)
    {
        static $config;
        if(empty($config)){
            $file = APP . 'config/config.php';
            if(file_exists($file))
                $config['base'] = require_once $filel;
            else
                exit("目录中应该包含一个config.php配置文件");
        }
    }
}
