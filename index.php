<?php
define('BASEPATH',realpath('./'));
define('APP', 'app/');
define('CORE', BASEPATH.'/core/');
define('LIB',  BASEPATH.'/lib/');
define('DEBUG', true);

if(DEBUG){
    error_reporting(-1);
    ini_set('display_errors', 1);
}
else {
    ini_set('display_errors', 0);
    error_reporting(version_compare(PHP_VERSION, '5.3', '>=') ? (E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED) : (E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE));
}

require_once LIB.'/helper.php';
require_once CORE.'/core.php';
spl_autoload_register(array('\core\Core', 'autoload'));
core\Core::run();
