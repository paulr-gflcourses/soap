<?php

$url="http://192.168.0.15/~user12/soap/task2/server/index.php";
$methodName = "getById";
$returnName = "parameters";
$elementName = '';
$params = ['id'=>'1'];

$client = new SoapClient($url.'?WSDL');
$res1 = $client->$methodName($params);
var_dump($res1);

?>
