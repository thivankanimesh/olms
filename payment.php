<?php

    session_start();

    if(isset($_SESSION["user-logged"])){
        $user_id = $_SESSION["user-logged"];
    }else{
        header('Location:index.php');
    }

?>

<?php 
    include "database.php";
?>

<?php 

    if(isset($_POST["form-checkout"])){

    }

?>