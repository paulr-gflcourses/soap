<?php
class SoapService
{
    public function getCarList()
    {
        try
        {
            $mysql = new MySQL();
            $mysql->setSql("SELECT id, mark, model FROM Cars");
            $result = $mysql->select();
        }catch(Exception $e)
        {
            throw new SoapFault("Server", $e->getMessage());
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($param)
    {
        $id = $param->id;
        if ( !$id || !is_numeric($id) || $id<0)
        {
            throw new SoapFault("Server", "Car id is ivalid!");
        }
        try
        {
            $mysql = new MySQL();
            $mysql->setSql("SELECT id, mark, model, year, engine, color, maxspeed, price FROM Cars WHERE id=$id");
            $result = $mysql->select();
        }catch(Exception $e)
        {
            throw new SoapFault("Server", $e->getMessage());
        }
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public function Order($order)
    {
        $idcar = $order->idcar;
        $type_pay = $order->payment;
        $cust_name = $order->firstname;
        $cust_surname = $order->lastname;
        if ( !$idcar || !is_numeric($idcar) || $idcar<0)
        {
            throw new SoapFault("Server", "Car id is ivalid!");
        }
        if ($type_pay!="cash" && $type_pay!="credit card"){
            throw new SoapFault("Server", "Payment type is ivalid!");
        }
        if (!$cust_name)
        {
            throw new SoapFault("Server", "Customer name is empty!");
        }
        if (!$cust_surname)
        {
            throw new SoapFault("Server", "Customer surnname is empty!");
        }
        try
        {
            $mysql = new MySQL();
            $sql = "INSERT INTO Orders(id, idcar, type_pay, cust_name, cust_surname) 
                VALUES(?, ?, ?, ?, ?)";
            $params = [0, $idcar, $type_pay, $cust_name, $cust_surname];
            $mysql->setSql($sql);
            $mysql->insert($params);
        }catch(Exception $e)
        {
            throw new SoapFault("Server", $e->getMessage()); 
        }
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

        }catch(Exception $e)
        {
            throw new SoapFault("Server", $e->getMessage()); 
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
}


?>
