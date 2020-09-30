<?php 
  
    require_once('config.php');

    $conn = new mysqli($servername, $username, $password);

    if($conn->connect_error){
        die("Connection Failed". $conn->connect_error);        
    }

    $sqlQuery = "Create Database ". $dbname;

    if($conn->query($sqlQuery) === true){
        echo "Database Created Successfully";
    }else{
        echo "Error Creating database: " .$conn->error;

    }

    $conn->close();
 

?>