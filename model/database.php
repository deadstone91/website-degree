<?php
 Class databaseCon{

     //setting variables
 var $dbName = 'newsdb';
 var $dbHost = 'localhost';
 var $dbUsername = 'root';
 var $dbPassword = '';

     function connection(){
         $connection = mysqli_connect($this->dbHost,$this->dbUsername,$this ->dbPassword,$this->dbName);

         if(!$connection){
             die("Connection Failed: " .mysqli_connect_error());
         }
         //echo "<script type='text/javascript'> console.log('db conected')</script>";
         return $connection;
     }
 }


