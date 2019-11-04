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
        $_SESSION["logged"]="$row->user_id";
        header('Location:account.php');

    }else{
        header('Location:index.php');
    }

?>