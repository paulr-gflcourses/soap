<?php
//require_once '/home/user12/public_html/soap/task2/server/config.php';

//include('E:\eng\xampp\htdocs\my\courses\soap\task2\server\config.php');
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
        $mysql->setSql("SELECT id, mark, model, year, engine, color, maxspeed, price FROM Cars WHERE id=$id");
        try
        {
            $result = $mysql->select();
            return $result->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e)
        {
            echo $e->getMessage();
            $car = ['id'=>1, 'mark'=>'BMW \n'.$e->getMessage(), 'model'=>'X3', 'year'=>1991, 'engine'=>3.3, 'color'=>'black', 'maxspeed'=>200, 'price'=>3000.0];       
            //$car = ['id'=>0, 'mark'=>'', 'model'=>'', 'year'=>0, 'engine'=>0, 'color'=>'', 'maxspeed'=>0, 'price'=>0];       
            return (object) $car;
            //return (object) ['id'=>0];
        }
        return (object) [];
    }

    public function Order($order)
    {
        $idcar = $order->idcar;
        $type_pay = $order->payment;
        $cust_name = $order->firstname;
        $cust_surname = $order->lastname;
        $mysql = new MySQL();
        $sql = "INSERT INTO orders(id, idcar, type_pay, cust_name, cust_surname) 
            VALUES(?, ?, ?, ?, ?)";
        echo $sql;
        $params = [0, $idcar, $type_pay, $cust_name, $cust_surname];
        $mysql->setSql($sql);
        $mysql->insert($params);
        return (object) ['id'=>$idcar];
    }

    public function CarFilter($data)
    {
        $sql="SELECT id, mark, model FROM Cars";
        $sql.=" WHERE year=".$data->year;
        if ($data->mark)
        {
            $sql.=" AND mark='$data->mark'";
        }
        if ($data->model)
        {
            $sql.=" AND model='$data->model'";
        }
        if ($data->engine)
        {
            $sql.=" AND engine=$data->engine";
        }
        if ($data->color)
        {
            $sql.=" AND color='$data->color'";
        }
        if ($data->maxspeed)
        {
            $sql.=" AND maxspeed=$data->maxspeed";
        }
        if ($data->price)
        {
            $sql.=" AND price=$data->price";
        }
        $mysql = new MySQL();

        $mysql->setSql($sql);
        $result = $mysql->select();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
}

//$service = new SoapService();
//$order = (object) ['idcar'=>3, 'payment'=>'cash', 'firstname'=>'Paul', 'lastname'=>'R.'];
//$service->Order($order);

////$car = $service->getById((object)['id'=>2]);
//$carList = $service->getCarList();
////print_r($car);
//print_r($carList);


?>
