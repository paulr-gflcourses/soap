<?php

require_once 'config.php';
require_once 'libs/CarClient.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
//$url="http://192.168.0.15/~user12/soap/task2/server/index.php";
/*$url='http://127.0.0.1/my/courses/soap/task2/server/index.php';
$methodName = "getById";
$returnName = "parameters";
$elementName = '';
$params = ['id'=>'3'];*/

//$methodName = "getCarList";
//$params = [];

/*$client = new SoapClient($url.'?wsdl', array('trace' => 1));
$res1 = $client->$methodName($params);
$req = $client->__getLastRequest();
$resp = $client->__getLastResponse();
echo '<h2>Request:</h2> <pre>';
var_dump($req);
echo '</pre><h2>Response:</h2> <pre>';
var_dump($resp);*/
//$res1 = $client->__getFunctions();
/*var_dump($res1);*/
//$_GET['action'] = 'getCarList';

if (isset($_POST['action'])) 
{
    $client = new CarClient();
	if ($_POST['action'] == 'getCarList')
	{
        header('Content-Type: application/json');
		echo $client->getCarList();
	}
}else
{
    header('Content-Type: text/html');

//    print_r($_POST);
    //print_r($_GET);
    require_once TEMPLATE;
}

?>
