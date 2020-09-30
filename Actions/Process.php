<?php 

    session_start();

    require_once('../Database/Config.php'); 

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("Connection Failed: ". $conn->connect_error);
    }else{
    // if insert data 
        if(isset($_POST['btn_insert'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $processType = $_POST['processType'];
    
            if($processType == 'traditional'){
                $sqlQuery = "insert into 
                tbl_users (firstname, lastname, email) 
                values('". $firstname ."', '". $lastname ."', '". $email ."')";
    
                if($conn->query($sqlQuery) === true){
                    // get last id 
                    $last_id = $conn->insert_id;
                    $_SESSION['success'] = "New record created successfully. The last inserted ID is ". $last_id; 
                }else{
                    $_SESSION['error'] = "Insertion of data failed. ";            
                }
                $conn->close();
                header("location: ../InsertData.php");
            }else{
                $stmt = $conn->prepare("insert into tbl_users (firstname, lastname, email) values (?, ?, ?)");
                $stmt->bind_param("sss", $firstname, $lastname, $email);
                $stmt->execute();

                $last_id = $conn->insert_id;
                $_SESSION['success'] = "New record created successfully. The last inserted ID is ". $last_id; 
                $stmt->close();
                $conn->close();
                header("location: ../InsertData.php"); 
            }     

        } elseif(isset($_POST['btn_delete'])){ 
            if(empty($_POST['id'])){
                $_SESSION['error'] = "Select first the item you want to delete.";
                if($_POST['paginate'] == 'paginate'){
                    header("location: ../SelectPaginate.php");
                }else{ 
                    header("location: ../SelectData.php");
                }
            }else{
                $counter = count($_POST['id']);
                for($x=0; $x<$counter; $x++){
                    if($stmt = $conn->prepare("Delete from tbl_users where id = ?")){
                        $stmt->bind_param("i", $_POST['id'][$x]); 
                        $stmt->execute();
                        $stmt->close();
                        $_SESSION['success'] = "Data Successfully Deleted";
                    }else{
                        $SESSION['error'] ="Error Deleting";
                    } 
                }
                $conn->close();
                if($_POST['paginate'] == 'paginate'){
                    header("location: ../SelectPaginate.php");
                }else{ 
                    header("location: ../SelectData.php");
                }
            } 

        }elseif(isset($_POST['btn_update'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email']; 
            $id = $_POST['id'];
            
            $sqlQuery = "update tbl_users set firstname = '". $firstname ."', lastname = '". $lastname ."', email = '". $email ."' where id = ". $id ."";

            if($conn->query($sqlQuery) === true){
                $_SESSION['success'] = "Data successfully Updated. "; 
            }else{
                $_SESSION['error'] = "Failed to update data. " .$id;
            }
            $conn->close();
            header("location: ../SelectPaginate.php");
        }
         
    }






 


?>