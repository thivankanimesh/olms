<?php

    $db_servername = "localhost";
    $db_username = "thivanka";
    $db_password = "thiva456";
    $db_name = "olms";

    $con = new PDO("mysql:host=$db_servername;dbname=$db_name",$db_username,$db_password);

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>