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

function serviceSoap2()
{
    $url="http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";
    $client = new SoapClient($url);
    $result = $client->NumberToWords(array('ubiNum' => '2931'));
    echo $result->NumberToWordsResult;
}

function serviceSoap3()
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

function serviceCurl()
{
    $url = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso";
    //$methodName = '/ListOfContinentsByName';
    $methodName = '/ListOfCountryNamesByName';
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url.$methodName);
    $output = curl_exec($ch); 
    print gettype($output);
    curl_close($ch);  

    //var_dump($output);
    //$oXML = new SimpleXMLElement($output);

    //$oXML = simplexml_load_string($output, 'SimpleXMLElement', LIBXML_NOCDATA);
    //var_dump($oXML);
    //foreach($oXML->entry as $oEntry){
        ////echo $oEntry->title . "\n";
        //var_dump($oEntry);

    //}
}

//serviceSoap1();
//serviceSoap2();
//serviceSoap3();
serviceCurl();

//include_once TEMPLATE;

?>
