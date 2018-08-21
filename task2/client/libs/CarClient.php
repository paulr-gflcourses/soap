<?php

//require_once '/home/user12/public_html/soap/task2/client/config.php';

class CarClient
{
	private $client;

	public function __construct()
	{
		$this->client = new SoapClient(SERVER_URL.'?wsdl');
	}

    public function getCarList()
    {
		$result = $this->client->getCarList();
		return json_encode($result);
    }

    public function CarFilter($data)
    {
        //$params =  ['year'=>2008,'mark'=>'Mercedes', 'model'=>'S-Class 550', 'engine'=>5.5, 
            //'color'=>'black', 'maxspeed'=>220, 'price'=>40000];
        $params =  ['year'=>$data['year'],'mark'=>$data['mark'], 'model'=>$data['model'], 'engine'=>$data['engine'], 
            'color'=>$data['color'], 'maxspeed'=>$data['maxspeed'], 'price'=>$data['price']];
        $result = $this->client->CarFilter($params);
        return json_encode($result);
    }

    public function getById($id)
    {
	   $result = $this->client->getById(['id'=>$id]);
	   return json_encode($result);
    }

    public function Order($order)
    {

    }


}

//$client = new CarClient();
//$car = $client->getById(3);
//print_r($car);
//////$cars = $client->getCarList();
////$cars = $client->CarFilter(11);
////print_r($cars);

?>
