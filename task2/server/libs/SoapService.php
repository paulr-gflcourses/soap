<?php
//require_once '/home/user12/public_html/soap/task2/server/config.php';
//include('E:\eng\xampp\htdocs\my\courses\soap\task2\server\config.php');
require_once 'SQL.php';
require_once 'MySQL.php';

class SoapService
{
    private $mysql;

    public function __construct()
    {
    }


    public function getCarList()
    {
        $mysql = new Mysql();
        $mysql->setSQL("SELECT id, mark, model FROM Cars");
        $result = $mysql->select();
        return $result->fetchAll(PDO::FETCH_OBJ);;
    }

    public function getById($param)
    {
        $mysql = new Mysql();
        $mysql->setSQL("SELECT id, mark, model, engine, color, maxspeed, price FROM Cars WHERE id=$param");
        $result = $mysql->select();
        $car = ['id'=>1, 'mark'=>'BMW', 'model'=>'X3', 'year'=>1991, 'engine'=>3.3, 'color'=>'black', 'maxspeed'=>200, 'price'=>3000.0];       
        //return (object) $car;
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public function Order($order)
    {

    }

    public function CarFilter($data)
    {

    }
}

//$service = new SoapService();
//$car = $service->getById(1);
//$carList = $service->getCarList();
//print_r($car);
//print_r($carList);

?>
