<?php
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

    public function getById()
    {
       $id = $_POST['id'];
	   $result = $this->client->getById(['id'=>$id]);
	   return json_encode($result);
    }

    public function Order($order)
    {

    }

    public function CarFilter($data)
    {
       

    }
}

?>
