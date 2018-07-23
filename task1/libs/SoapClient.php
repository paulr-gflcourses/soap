<?php
include_once "config.php";
$url="http://www.webservicex.com/CurrencyConvertor.asmx?wsdl";
$url="https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
//$url="http://webservices.amazon.com/AWSECommerceService/AWSECommerceService.wsdl";
 $client = new SoapClient($url);

var_dump($client->__getFunctions());
$result = $client->CelsiusToFahrenheit(array('Celsius' => '10'));

echo $result->CelsiusToFahrenheitResult . "\n";
//include_once TEMPLATE;


?>
