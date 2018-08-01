<?php
include_once "config.php";
include_once "libs/WSDLService.php";

$celsius='';
$celsToFar='';
$errorCelsius='';

$countryList='';
$errorCountries='';

try
{
    if ($_GET['celsius'])
    {

        $celsius = $_GET['celsius'];
        if (!is_numeric($celsius))
        {
            throw new Exception(ERR_NOT_A_NUMBER);
        }
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
}catch(Exception $e)
        {
            $errorCelsius = $e->getMessage();
        }
try
{
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
}catch(Exception $e)
        {
            $errorCountries = $e->getMessage();
        }

include_once TEMPLATE;

?>
