<?php
require_once 'config.php';
require_once 'libs/SoapService.php';

$wsdlUrl='http://192.168.0.15/~user12/soap/server/service.wsdl';
$server = new SoapServer($wsdlUrl);
$server->setClass("libs/SoapService.php");
$server->handle();

?>
