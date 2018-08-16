<?php


class CarService
{
    private $mysql;
    
    public function __construct()
    {
        $this->mysql = new Mysql();
    }

   public  function getCarList()
   {
       $this->mysql->select("SELECT id, brand, model FROM Cars");
   }
}


?>
