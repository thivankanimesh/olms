<?php 
    session_start();

    include "database.php";
?>

<?php

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "select * from user where email = '$email'";

    $result = mysqli_query($con,$query);

    $con->close();

    $row = $result->fetch_object();

    if(password_verify($password,$row->password)){

        $_SESSION["user-logged"]="$row->user_id";
        
        if(isset($_POST["user-login-modal"])){
            header('Location:account.php');
        }else if(isset($_POST["user-login-view"])){
            header('Location:index.php');
        }

    }else{
        header('Location:index.php');
    }

?>