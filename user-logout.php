<?php

    if(!$_SESSION["logged"]){
        header('Location:index.php');
    }

    session_start();

    unset($_SESSION["logged"]);

    header('Location:index.php');
?>