<?php
//require_once '/home/user12/public_html/soap/task2/server/config.php';
////include('E:\eng\xampp\htdocs\my\courses\soap\task2\server\config.php');
//require_once 'SQL.php';
//require_once 'MySQL.php';

class SoapService
{

    public function getCarList()
    {
        $mysql = new MySQL();
        $mysql->setSql("SELECT id, mark, model FROM Cars");
        $result = $mysql->select();
        return $result->fetchAll(PDO::FETCH_OBJ);
        //return (object)['id'=>0, 'mark'=>'none', 'model'=>'none'];
    }

    public function getById($param)
    {
        $mysql = new MySQL();
        $id = $param->id;
        $mysql->setSql("SELECT id, imark, model, engine, color, maxspeed, price FROM Cars WHERE id=$id");
        try
        {
            $result = $mysql->select();
            return $result->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e)
        {
            $car = ['id'=>1, 'mark'=>'BMW \n'.$e->getMessage(), 'model'=>'X3', 'year'=>1991, 'engine'=>3.3, 'color'=>'black', 'maxspeed'=>200, 'price'=>3000.0];       
            $car = ['id'=>0, 'mark'=>'', 'model'=>'', 'year'=>0, 'engine'=>0, 'color'=>'', 'maxspeed'=>0, 'price'=>0];       
            return (object) $car;
            //return (object) ['id'=>0];
        }
        return (object) [];
    }

    public function Order($order)
    {

    }

    public function CarFilter($data)
    {
        $mysql = new MySQL();
        var_dump($data);
        $mysql->setSql("SELECT id, mark, model FROM Cars");

    }
}

//$service = new SoapService();
////$car = $service->getById((object)['id'=>2]);
//$carList = $service->getCarList();
////print_r($car);
//print_r($carList);

?>
