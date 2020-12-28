<?php
//PHP Settings

error_reporting(E_ALL |E_STRICT);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/Berlin');
//Normal Defines
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
define('CMS_PATH', ROOT_PATH . '/lib/core/');
define('WEB_ROOT', substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], 'index.php')));
$config = parse_ini_file(ROOT_PATH . "/config/config.ini", true);
//Start Session
session_start();

/*Require*/
require_once ROOT_PATH."/vendor/autoload.php";
require_once ROOT_PATH."/lib/database/database.php";
include(ROOT_PATH.'/config/routes.php');

/*Autoloader*/
function autoloader($className) {
    if (file_exists(CMS_PATH . $className . '.php')) {
        require_once CMS_PATH . $className . '.php';
    }
    else if (file_exists(ROOT_PATH . '/lib/' . $className . '.php')) {
        require_once ROOT_PATH . '/lib/' . $className . '.php';
    }
    else if(file_exists(ROOT_PATH . '/app/models/'.$className.'.php')) {
        require_once ROOT_PATH . '/app/models/'.$className.'.php';
    } else {

    }
}

spl_autoload_register('autoloader');

/*Router*/
$router = new Router();
$router->run($routes);




