<?php 
    session_start();

    $admin = $_SESSION["logged"];

    if(!$_SESSION["admin-logged"]){
        header('Location:index.php');
    }

?>

<?php
    include "database.php";
?>

<?php

    // Getting user count
    $query = "select count(user_id) from user";
    $user_result = mysqli_query($con,$query);
    $user_array = mysqli_fetch_array($user_result);
    $user_count = $user_array[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body background="resources/img/background2.jpg" style="background-size: 100%;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div style="margin-bottom: 10px">
                    <?php 
                    require "components/header/main-header.php";
                    ?>
                </div>
            </div>
        </div>

        <div class="row" style="padding-top: 10px">
            <div class="col-sm" style="padding-right: 2px;">
                <a href="user.php" style="text-decoration: none">
                    <div class="card text-white bg-dark mb-3" style="max-width: 25rem">
                        <div class="card-body">
                            <h1><?php echo $user_count?></h1>
                            <h6>Total Users</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>