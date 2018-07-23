<?php
include_once "config.php";

function serviceSoap1()
{
    $url="http://www.webservicex.com/CurrencyConvertor.asmx?wsdl";
    $url="https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
    //$url="http://webservices.amazon.com/AWSECommerceService/AWSECommerceService.wsdl";
    $client = new SoapClient($url);

    var_dump($client->__getFunctions());
    $result = $client->CelsiusToFahrenheit(array('Celsius' => '10'));

    echo $result->CelsiusToFahrenheitResult . "\n";
}

function serviceSoap2()
{
    $url="https://demo.myalm.ru/api/dataservice?wsdl";
    $data =  array( 'soap_version'=>SOAP_1_1, 'cache_wsdl' => WSDL_CACHE_NONE, 'trace'=>true );

    $client = new SoapClient($url,$data);

    var_dump($client->__getFunctions());

    $result = $client->RemoteGetAll(array('token' => 'all'));
    var_dump($result);
    echo $result;


    $security = new SoapClient(
        'https://demo.myalm.ru/api/securityservice?wsdl',
        array(
            'soap_version'=>SOAP_1_1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace'=>true
        )
    );

    $result = $security->login(
        array(
            'username' => 'Alik12',
            'userpass' => '12345',
            'project' => ''
        )

    );
    $token = $result->return;
    var_dump($token);


}


//serviceSoap1();
serviceSoap2();

//include_once TEMPLATE;

?>
