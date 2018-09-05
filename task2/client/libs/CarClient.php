<?php
//require_once '/home/user12/public_html/soap/task2/client/config.php';
//require_once 'E:\eng\xampp\htdocs\my\courses\soap\task2\client\config.php';

class CarClient
{
    private $client;

    public function __construct()
    {
        $this->client = new SoapClient(SERVER_URL.'?wsdl',['exceptions'=>true, 'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
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

        //$params =  ['year'=>$data['year'],'mark'=>$data['mark'], 'model'=>$data['model'], 'engine'=>$data['engine'], 
        //'color'=>$data['color'], 'maxspeed'=>$data['maxspeed'], 'price'=>$data['price']];
        try{
            if ($data['year'])
            {
                $result = $this->client->CarFilter($data);
            }else
            {
                throw new Exception('No year selected!');
            }
        }catch(Exception $e)
        {
            return json_encode(['errors'=>$e->getMessage()]);
        }

        return json_encode($result);
    }

    public function getById($id)
    {
        $result = $this->client->getById(['id'=>$id]);
        return json_encode($result);
    }

    public function Order($order)
    {
        try
        {
            $params=['idcar'=>$order['idcar'], 'firstname'=>$order['firstname'],
                'lastname'=>$order['lastname'], 'payment'=>$order['payment']];
            $result = $this->client->Order($params);
        }catch(Exception $e)
        {
            return json_encode(['errors'=>$e->getMessage()]);
        }
        return json_encode($result);
    }


}

//$client = new CarClient();
////$car = $client->getById('daa');
//try{
//$car = $client->CarFilter(['year'=>1.3325, 'lkjl'=>'fkjk']);
//print_r($car);
//}catch(SoapFault $e)
//{
//echo "Error:". $e->getMessage();
//}


//////$cars = $client->getCarList();
////$cars = $client->CarFilter(11);
////print_r($cars);

?>
