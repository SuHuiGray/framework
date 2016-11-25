<?php
namespace app\modules;
use core\Module as Module;
class User extends Module
{
    private $table = 'tag';
    public function __construct($options)
    {
        parent::__construct($options);
        p("User module extends Module");
    }
}
