<?php
include_once "SQL.php";

class MySQL extends SQL
{

    function connect()
    {
        $this->setDsn("mysql:host=".HOSTNAME.";dbname=".DBNAME);
        $this->setUsername(USERNAME);
        $this->setPassword(PASSWORD);
        parent::connect();
    }

    //function select($sql)
    //{
        ////$userid = $this->getUserId();
        ////$table = $this->getTable();
        ////$this->setSql("SELECT userid, userdata FROM $table WHERE userid='$userid'");
        //$this->setSql($sql);
        //return parent::select();
    //}

    //function insert($sql)
    //{
        ////$table = $this->getTable();
        ////$this->setSql("INSERT INTO $table (userid, userdata) VALUES (?, ?)"); 
        //$this->setSql($sql); 
        //parent::insert();
    //}

    //function update($sql)
    //{
        ////$table = $this->getTable();
        ////$this->setSql("UPDATE $table SET userdata=? WHERE userid=?");
        //$this->setSql($sql); 
        //parent::update();
    //}

    //function delete($sql)
    //{
        ////$table = $this->getTable();
        ////$this->setSql("DELETE FROM $table WHERE userid=? AND userdata=? LIMIT 1");
        //$this->setSql($sql); 
        //parent::delete();
    //}



}

?>
