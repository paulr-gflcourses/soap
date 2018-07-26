<?php
include_once "config.php";
include_once "libs/WSDLService.php";


if ($_GET['celsius'])
{
    $celsius = $_GET['celsius'];
    $url="https://www.w3schools.com/xml/tempconvert.asmx";
    $methodName = "CelsiusToFahrenheit";
    $returnName = "CelsiusToFahrenheitResult";
    $elementName = '';
    $params = ['Celsius'=>"$celsius"];

    $service = new WSDLService($url, $methodName, $returnName, $elementName, $params);
    if ($_GET['typeSend']=='soap')
    {
        $celsToFar = $service->soapMethod();
    }else
    {
        $celsToFar = $service->curlMethod();
    }
}

if ($_GET['countryList'])
{
    $url2 = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso";
    $methodName2 = "ListOfCountryNamesByName";
    $returnName2 = "ListOfCountryNamesByNameResult";
    $elementName2 = "tCountryCodeAndName";
    $service2 = new WSDLService($url2, $methodName2, $returnName2, $elementName2);
    if ($_GET['typeSend']=='soap')
    {
        $countryList = $service2->soapMethod();
    }else
    {
        $countryList = $service2->curlMethod();
    }
}

include_once TEMPLATE;

?>
