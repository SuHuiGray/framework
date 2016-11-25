<?php
namespace app\controllers;
use app\modules\User as User;
class Home extends \core\Core
{
    private $options = array(
        'type' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'blog',
        'username' => 'root',
        'password' => '123456',
        'charset' => 'utf8'
    );
    public function index()
    {
        p('Home controller');
        $user = new User($this->options);
        // p($user->get('tag'));
        $this->v('index', array('index'=>'hello world'));
    }
}
