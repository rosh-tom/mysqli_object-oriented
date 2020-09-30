<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>HOME</h1>
    <p>
        <?php 
            include('Messages.php'); 
        ?>
    </p>
    <p><a href="InsertData.php">Insert Data</a></p>
    <!-- <p><a href="SelectData.php">Select Data</a></p> -->
    <p><a href="SelectPaginate.php">Select Data With Pagination</a></p>
    
</body>
</html>