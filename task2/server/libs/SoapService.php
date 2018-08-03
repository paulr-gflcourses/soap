<?php

class SoapService
{

    public function __construct()
    {

    }


    public function getCarList()
    {

    }

    public function getById($param)
    {
        $car = ['id'=>1, 'mark'=>'BMW', 'model'=>'X3', 'year'=>1991, 'engine'=>3.3, 'color'=>'black', 'maxspeed'=>200, 'price'=>3000.0];       
        return (object) $car;
    }

    public function Order($order)
    {

    }

    public function CarFilter($data)
    {

    }
}


?>
