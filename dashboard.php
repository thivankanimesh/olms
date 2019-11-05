<?php 
    session_start();

    if(isset($_SESSION["logged"])){
        $admin = $_SESSION["logged"];
    }

    if(!isset($_SESSION["admin-logged"])){
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

    // Getting ebook count
    $query = "select count(ebook_id) from ebook inner join admin on admin.admin_id = ebook.admin_id";
    $ebook_result = mysqli_query($con,$query);
    $ebook_array = mysqli_fetch_array($ebook_result);
    $ebook_count = $ebook_array[0];

    // Getting author count
    $query = "select count(author_id) from author inner join admin on admin.admin_id = author.admin_id";
    $author_result = mysqli_query($con,$query);
    $author_array = mysqli_fetch_array($author_result);
    $author_count = $author_array[0];

    // Getting publisher count
    $query = "select count(publisher_id) from publisher inner join admin on admin.admin_id = publisher.publisher_id";
    $publisher_result = mysqli_query($con,$query);
    $publisher_array = mysqli_fetch_array($publisher_result);
    $publisher_count = $publisher_array[0];

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
<body background="resources/img/background.jpg" style="background-size: 100%;">
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
            <div class="col-sm" style="padding-right: 2px;">
                <a href="" style="text-decoration: none;">
                    <div class="card text-white bg-danger mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h1><?php echo $ebook_count?></h1>
                            <h6>Total Ebooks</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="author.php" style="text-decoration: none;">
                    <div class="card text-white bg-primary mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h1><?php echo $author_count?></h1>
                            <h6>Total Authors</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="" style="text-decoration: none;">
                    <div class="card text-white bg-success mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h1><?php echo $publisher_count?></h1>
                            <h6>Total Publishers</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>