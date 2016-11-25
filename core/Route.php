<?php
namespace core;
class Route
{
    public $controller; #控制器
    public $method;     #方法
    public $params = array();   #参数
    public $queryStr;   #查询字符串
    public $directory = APP . 'controllers/';  #controller的子目录
    public $ctlFile;    #控制器文件
    public $fullClass;  #类的命名空间+类名
    public function __construct()
    {
        $this->handle_uri();
    }

    /*
     * 解析uri
    */
    private function handle_uri()
    {
        $uri = 'http://www.dummy.com' . $_SERVER['REQUEST_URI'];
        $uris = parse_url($uri);

        $path = $uris['path'];
        $this->queryStr = isset($uris['query']) ? $uris['query'] : '';
        $this->resolev_path($path);
    }

    /*
     * 处理uri中的path部分，解析控制器，方法
    */
    private function resolev_path($path)
    {
        $pjpath = $_SERVER['SCRIPT_NAME']; #入口文件对于webroot的相对路径

        //去除uri中项目目录
        if(strpos($path, $pjpath) === 0){
            $path = substr($path, strlen($pjpath));
        }
        else if(strpos($path, dirname($pjpath)) === 0){
            $path = substr($path, strlen(dirname($pjpath)));
        }

        if($path =='/'){
            $this->controller = 'Home';
            $this->method = 'index';
            $this->fullClass = str_replace('/', '\\', $this->directory) . $this->controller;
            return;
        }
        $path = trim($path, '/');

        //将path中目录部分分离出来
        $pathDetail = $this->set_directory(explode('/', $path));

        //处理控制器和方法
        if(isset($pathDetail[0])){
            $this->controller = ucfirst($pathDetail[0]);
            $this->fullClass = str_replace('/', '\\', $this->directory) . $this->controller;
        }

        if(isset($pathDetail[1]))
            $this->method = $pathDetail[1];

        //处理传递的参数
        $len = count($pathDetail);
        for($i=2; $i<$len; $i=$i+2){
            if(!isset($pathDetail[$i+1]))
                break;

            $this->params[$pathDetail[$i]] = $pathDetail[$i+1];
        }
    }

    /*
     * 检查控制器是否在controller的一个子目录下
     */
    private function set_directory($pathDetail){
        while(!empty($pathDetail)){
            if(is_dir($this->directory  . $pathDetail[0])){
                $this->directory = $this->directory . $pathDetail[0] . '/';
                array_shift($pathDetail);
            }
            else
                break;
        }

        return $pathDetail;
    }

}
