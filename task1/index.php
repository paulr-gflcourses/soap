<?php
include_once "config.php";

function serviceSoap1()
{
    $url="https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
    $client = new SoapClient($url);

    var_dump($client->__getFunctions());
    $result = $client->CelsiusToFahrenheit(array('Celsius' => '10'));

    echo $result->CelsiusToFahrenheitResult . "\n";
}

function serviceCurl()
{
    $url="https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
    $ch = curl_init($url);

    //$fp = fopen("example_homepage.txt", "w");
    //curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    return false;
}

function serviceSoap2()
{
    //$url="https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
    //$url="http://webservices.amazon.com/AWSECommerceService/AWSECommerceService.wsdl";
    $url="https://demo.myalm.ru/api/securityservice?wsdl";
    $url="https://demo.myalm.ru/api/dataservice?wsdl";
    $data =  array( 'soap_version'=>SOAP_1_1, 'cache_wsdl' => WSDL_CACHE_NONE, 'trace'=>true );

    $client = new SoapClient($url,$data);

    var_dump($client->__getFunctions());

    //$result = $client->RemoteGetAll(array('Celsius' => '10'));

    //$security = new SoapClient(
        //'https://demo.myalm.ru/api/securityservice?wsdl',
        //array(
            //'soap_version'=>SOAP_1_1,
            //'cache_wsdl' => WSDL_CACHE_NONE,
            //'trace'=>true

        //)

    //);
    //$result = $security->login(
        //array(
            //'username' => '*****',
            //'userpass' => '****',
            //'project' => '****'
        //)

    //);
    //$token = $result->return;
    //var_dump($token);


}

function serviceSoap3()
{
    $url="http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";
    $client = new SoapClient($url);

    //var_dump($client->__getFunctions());
    $result = $client->NumberToWords(array('ubiNum' => '2931'));
    echo $result->NumberToWordsResult;
}

//serviceSoap1();
//serviceSoap2();
serviceSoap3();

//include_once TEMPLATE;

?>
