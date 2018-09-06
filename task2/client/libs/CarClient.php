<?php

class CarClient
{
    private $client;

    public function __construct()
    {
        $this->client = new SoapClient(SERVER_URL.'?wsdl',['exceptions'=>true, 'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
    }

    public function getCarList()
    {
        try{
        $result = $this->client->getCarList();
    }catch(Exception $e)
    {
        return json_encode(['errors'=>$e->getMessage()]);
    }
        return json_encode($result);
    }

    public function CarFilter($data)
    {
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
        try{
        $result = $this->client->getById(['id'=>$id]);
    }catch(Exception $e)
    {
        return json_encode(['errors'=>$e->getMessage()]);
    }
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


?>
