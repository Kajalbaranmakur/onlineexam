<?php
      $server    = "localhost";
      $username  = "root";
      $password  = "";
      $database  = "onlineexam";

      //create mysqli object
      $connection = new mysqli($server, $username, $password, $database);

      //error hendler
      if($connection->connect_error){
          echo "Connection failed! ".$connection->connect_error;
          exit();
      }        
?>