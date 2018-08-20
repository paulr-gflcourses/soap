<?php
require_once 'config.php';
require_once 'libs/SQL.php';
require_once 'libs/MySQL.php';
require_once 'libs/SoapService.php';

ini_set("soap.wsdl_cache_enabled", 0);
if(array_key_exists('wsdl', $_GET))
{
    header("Content-Type: text/xml; charset=utf-8");
    header('Cache-Control: no-store, no-cache');
    header('Expires: '.date('r'));
    echo file_get_contents(WSDL_PATH);
    exit;
}
else
{
    //$wsdlUrl='http://192.168.0.15/~user12/soap/task2/server/index.php?wsdl';
    $wsdlUrl='http://127.0.0.1/my/courses/soap/task2/server/index.php?wsdl';
    $server = new SoapServer($wsdlUrl);
    $server->setClass("SoapService");
    $server->handle();
}

?>
