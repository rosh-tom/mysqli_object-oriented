<?php 
    session_start();
    require_once('Database/Config.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Data</title>
    <style>
        .btn_delete{
            background-color: red; 
        }
        .btn_delete:hover{
            background-color: white;
            color: red;
            cursor: pointer; 
        }
    </style>
</head>
<body>
    
    <span><a href="Index.php"><- BACK</a></span>
    <h1>SELECT DATA</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
         <?php
             include('Messages.php') 
          ?>
            <form action="Actions/Process.php" method="post">
                <input class="btn_delete" type="submit" name="btn_delete" value="Delete" />
                <?php 
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $sqlQuery = "Select * from tbl_users";
                    $result = $conn->query($sqlQuery);
                    if(! $result->num_rows > 0){
                        echo "Empty";
                    }else{
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td> <input type='checkbox' name='id[]' value='". $row['id']."'></td>";
                            echo "<td>". $row['id'] ."</td>";
                            echo "<td>". $row['firstname'] ."</td>";
                            echo "<td>". $row['lastname'] ."</td>";
                            echo "<td>". $row['email'] ."</td>"; 
                            echo "<td> <a href=''> Edit </td>"; 
                            echo "</tr>";
                        }
                    }
                ?> 
         </form>
        </tbody>
    </table>
</body>
</html>