<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
</head>
<body>
    <span><a href="Index.php"><- BACK</a></span>
    <h1>INSERT DATA</h1>
    <?php 
        if(isset($_SESSION['error'])){
            echo "<span style='color: red'>". $_SESSION['error'] ."</span>";
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
            echo "<span style='color: green'>". $_SESSION['success'] ."</span>";
            unset($_SESSION['success']);
        }
    ?>
    <form action="Actions/Process.php" method="post">
        <p>
            <select name="processType" >
                <option value="traditional">Traditional</option>
                <option value="prepared">Prepared</option>
            </select>
        </p>
        <p><input type="text" placeholder="First Name" required name="firstname"></p>
        <p><input type="text" placeholder="Last Name" required name="lastname"></p>
        <p><input type="email" placeholder="email" required name="email"></p>
        <p><input type="submit" value="Insert" name="btn_insert"></p>
    </form>
    
</body>
</html>