<?php
include_once "config.php";

function serviceSoap1()
{
    $url="https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
    $client = new SoapClient($url);
    //var_dump($client->__getFunctions());
    $result = $client->CelsiusToFahrenheit(array('Celsius' => '10'));
    echo $result->CelsiusToFahrenheitResult . "\n";
}

function soapMethod($url, $methodName, $returnName, $params=[])
{
    $client = new SoapClient($url.'?WSDL');
    $result = $client->$methodName($params);
    return $result->$returnName;
}
//function serviceSoap2()
//{
    //$url="http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";
    //$client = new SoapClient($url);
    //$result = $client->NumberToWords(array('ubiNum' => '2931'));
    //echo $result->NumberToWordsResult;
//}

function serviceSoap2()
{
    $url = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
    $client = new SoapClient($url);
    var_dump($client->__getFunctions());
    //$result = $client->ListOfContinentsByName();
    $result = $client->ListOfCountryNamesByName();
    $result = $result->ListOfCountryNamesByNameResult->tCountryCodeAndName;
    var_dump($result);
    print $result[0]->sName;
    //$res2 = $result->ListOfContinentsByNameResult->tContinent;
    //var_dump($res2);
}

function serviceCurl2()
{
    $url = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso";
    //$methodName = '/ListOfContinentsByName';
    $methodName = '/ListOfCountryNamesByName';
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url.$methodName);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch); 
    curl_close($ch);  

    var_dump($output);
    //$oXML = new SimpleXMLElement($output);
    $countries = simplexml_load_string($output);
    foreach($countries as $country){
        echo $country->sName." (".$country->sISOCode.")\n";
    }
}

function serviceCurl1()
{
    $url="https://www.w3schools.com/xml/tempconvert.asmx";
    $methodName = '/CelsiusToFahrenheit';
    $data = ['Celsius'=>'10'];
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url.$methodName);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $output = curl_exec($ch); 
    curl_close($ch);  
    $fahrenheit = simplexml_load_string($output);
    print $fahrenheit;
}

function curlMethod($url, $methodName, $params=[])
{
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url.'/'.$methodName);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($params)
    {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    }
    $output = curl_exec($ch); 
    curl_close($ch);  
    return simplexml_load_string($output);
}

$url="https://www.w3schools.com/xml/tempconvert.asmx";
$methodName = "CelsiusToFahrenheit";
$returnName = "CelsiusToFahrenheitResult";
$params = ['Celsius'=>'10'];
//echo soapMethod($url, $methodName, $returnName, $params);
echo curlMethod($url, $methodName, $params);


$url = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso";
$methodName = "ListOfCountryNamesByName";
$returnName = "ListOfCountryNamesByNameResult";
//var_dump(soapMethod($url, $methodName, $returnName));
var_dump(curlMethod($url, $methodName));
//serviceSoap1();
//serviceSoap2();
//serviceSoap3();
//serviceCurl1();

//include_once TEMPLATE;

?>
