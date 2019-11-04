<?php 
    session_start();

    include "database.php";
?>

<?php

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "select * from admin where email = '$email'";

    $result = mysqli_query($con,$query);

    $con->close();

    $row = $result->fetch_object();

    if(password_verify($password,$row->password)){
        $_SESSION["admin-logged"]="$row->admin_id";
        header('Location:dashboard.php');

    }else{
        header('Location:index.php');
    }

?>