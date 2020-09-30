<?php 

    require_once('Config.php');    

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Connection Failed: ". $conn->connect_error);
    }

    // Name of the table 
    $tableName = 'tbl_users';
    
    $sqlQuery = "Create Table ". $tableName ." (
        id INT(6) Unsigned Auto_increment Primary Key,
        firstname varchar(30) not null,
        lastname varchar(30) not null,
        email varchar(30) not null,
        create_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    )";

    if($conn->query($sqlQuery) === true){
        echo "Table ". $tableName ." is successfully created. ";
    }else{
        echo "Error creating the table(". $tableName ." ". $conn->error;

    }
    $conn->close();
 

?>