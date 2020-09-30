<?php
        require_once('Database/Config.php');
        session_start();

        if(!isset($_GET['edit'])){
            echo "Hello World";
        }else{
            $conn = new mysqli($servername, $username, $password, $dbname);
            $id = $_GET['edit'];
            $sqlQuery = "Select * from tbl_users where id= ". $id ."";
            if(! $result = $conn->query($sqlQuery)){
                $_SESSION['error'] = "Error 404 : NOT FOUND.";
                header("location: Index.php");
            }else{ 
                if(! $result->num_rows > 0){
                    $_SESSION['error'] = "Error 404 : NOT FOUND.";
                    header("location: SelectData.php");
                }else{ 
               $row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
</head>
<body>
    <span><a href="SelectPaginate.php"><- BACK</a></span>
    <h1>INSERT DATA</h1>
    <p>
        <?php 
            include('Messages.php');
        ?>    
    </p>
    <form action="Actions/Process.php" method="post"> 
        <input type="hidden" name="id" value="<?= $row['id'] ?>" >
        <p><input type="text" placeholder="First Name" required name="firstname" value="<?= $row['firstname'] ?>"></p>
        <p><input type="text" placeholder="Last Name" required name="lastname" value="<?= $row['lastname'] ?>"></p>
        <p><input type="email" placeholder="email" required name="email" value="<?= $row['email'] ?>"></p>
        <p><input type="submit" value="update" name="btn_update"></p>
    </form>
    
</body>
</html>


<?php  
                       }
                    }
                     
                    
                }


?>