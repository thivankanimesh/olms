<?php

    if(!$_SESSION["user-logged"]){
        header('Location:index.php');
    }

    session_start();

    unset($_SESSION["user-logged"]);

    header('Location:index.php');
?>