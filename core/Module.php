<?php
namespace core;
class Module
{
    protected $type;                #数据库类型
    protected $host;                #地址
    protected $dbname;              #数据库名
    protected $username;            #数据库用户名
    protected $password;            #密码
    protected $charset = 'utf8';   #字符集

    protected $pdo;                 #数据库连接实例

    public function __construct($options)
    {
        if(empty($options))
            exit("必须要传入连接数据库的参数");

        foreach($options as $option=>$val){
            $this->$option = $val;
        }

        $dsn = '';
        $type = strtolower($this->type);
        switch($type){
            case 'mysql' :
                $dsn = $type.':dbname='.$this->dbname.';host='.$this->host;
                break;
        }

        p(__CLASS__);
        $commands = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$this->charset
        );

        $this->pdo = new \PDO($dsn, $this->username, $this->password, $commands);
        // $this->pdo->exec("SET NAMES '{$this->charset}'");
    }

    public function get($table)
    {
        $sql = "SELECT * FROM {$table}";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}
