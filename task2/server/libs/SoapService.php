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
        $year = $data->year;
        $mark = $data->mark;
        $model = $data->model;
        $engine = $data->engine;
        $color = $data->color;
        $maxspeed = $data->maxspeed;
        $price = $data->price;

        if (!$year || !is_integer($year) || $year<1930 || $year>2018)
        {
            throw new SoapFault("Server", "Year is not valid!"); 
        }
        $sql="SELECT id, mark, model FROM Cars";
        $sql.=" WHERE year=$year";

        if ($mark)
        {
            if (!is_string($mark))
            {
                throw new SoapFault("Server", "Mark is not valid!"); 
            }
            $sql.=" AND mark='$mark'";
        }
        if ($model)
        {
            if (!is_string($model))
            {
                throw new SoapFault("Server", "Model is not valid!"); 
            }
            $sql.=" AND model='$model'";
        }
        if ($engine)
        {
            if (!is_numeric($engine) || $engine<0)
            {
                throw new SoapFault("Server", "Engine is not valid!"); 
            }
            $sql.=" AND engine=$engine";
        }
        if ($color)
        {
            if (!is_string($color))
            {
                throw new SoapFault("Server", "Color is not valid!"); 
            }
            $sql.=" AND color='$color'";
        }
        if ($maxspeed)
        {
            if (!is_integer($maxspeed) || $maxspeed<0)
            {
                throw new SoapFault("Server", "Max speed is not valid!"); 
            }
            $sql.=" AND maxspeed=$maxspeed";
        }
        if ($price)
        {
            if (!is_numeric($price) || $price<0)
            {
                throw new SoapFault("Server", "Price is not valid!"); 
            }
            $sql.=" AND price=$price";
        }

        try
        {
            $mysql = new MySQL();
            $mysql->setSql($sql);
            $result = $mysql->select();
            return $result->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e)
        {
            throw new SoapFault("Server", $e->getMessage()); 
        }
        return (object)[];
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
