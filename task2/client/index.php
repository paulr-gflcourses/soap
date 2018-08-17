<?php

$url="http://192.168.0.15/~user12/soap/task2/server/index.php";
//$url='http://127.0.0.1/my/courses/soap/task2/server/index.php';
$methodName = "getById";
$returnName = "parameters";
$elementName = '';
$params = ['id'=>'1'];

$client = new SoapClient($url.'?wsdl');
//$res1 = $client->$methodName($params);
$res1 = $client->__getFunctions();
var_dump($res1);

?>
