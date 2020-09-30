<?php 
    session_start();
    require_once('Database/Config.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Data With Pagination</title>
    <style>
        .btn_delete{
            background-color: red; 
        }
        .btn_delete:hover{
            background-color: white;
            color: red;
            cursor: pointer; 
        }
        a.disabled{
            pointer-events: none;
            cursor: default;
            color: gray;
        }
        a{
            padding-right: 10px;
            border: 1px
        }
    </style>
</head>
<body>
    
    <span><a href="Index.php"><- BACK</a></span>
    <h1>Select Data With Pagination</h1>
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <!-- <th>ID</th> -->
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <p>
                <?php
                    include('Messages.php');
                ?>         
            </p>
            <form action="SelectPaginate.php" method="post">                
                <input type="text" name="search" /> <input type="submit" name="btn_search" value="Search">
            </form> 
            <br> <br>
            <form action="Actions/Process.php" method="post">
                <input type="hidden" name="paginate" value="paginate">
                <input class="btn_delete" type="submit" name="btn_delete" value="Delete" /> &nbsp; 
                <?php   
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $resultPerPage = 10;   

                    $sqlQuery = "Select * from tbl_users";
                    $result = $conn->query($sqlQuery);
                    $numberOfResult = $result->num_rows;

                    $numberOfPages = ceil($numberOfResult/$resultPerPage); 

                    if(!isset($_GET['page'])){
                        $page = 1;
                    }else{
                        $page = $_GET['page'];
                    }
                    
                    $pageResult = ($page-1)*$resultPerPage;

                    if(isset($_POST['btn_search'])){
                        $sqlQuery = "select * from tbl_users where firstname like '%". $_POST['search'] ."%' or lastname like '%". $_POST['search'] ."%'"; 
                        $result = $conn->query($sqlQuery);
                        $numberOfResult = $result->num_rows; 
                        $numberOfPages = ceil($numberOfResult/$resultPerPage); 
                    }else{ 
                        $sqlQuery = "select * from tbl_users limit ". $pageResult .", ". $resultPerPage; 
                    } 
                    $result = $conn->query($sqlQuery);
                    if(! $result->num_rows > 0){
                        echo "<tr>";
                        echo "<td colspan='6' style='background-color: pink'>
                                <center>
                                    Empty
                                </center>
                            <td>";
                        echo "</tr>";
                    }else{
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td> <input type='checkbox' name='id[]' value='". $row['id']."'></td>";
                            // echo "<td>". $row['id'] ."</td>";
                            echo "<td>". $row['firstname'] ."</td>";
                            echo "<td>". $row['lastname'] ."</td>";
                            echo "<td>". $row['email'] ."</td>"; 
                            echo "<td> <a href='Update.php?edit=". $row['id'] ."'> Edit </a></td>"; 
                            echo "</tr>";
                        }
                    } 
                    
                ?> 
         </form>
        </tbody>
    </table>

    <?php 
          for($p=1; $p<=$numberOfPages; $p++){
            
            echo "<a href='SelectPaginate.php?page=". $p ."' ". (($page==$p)?'class="disabled"':'').">". $p ."</a> ";
        }
    
        if($page == $p){
            $disable='disabled'; 
           }
    ?>
</body>
</html>