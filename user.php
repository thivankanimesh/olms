<?php
    session_start();

    $admin = $_SESSION["admin-logged"];

    if(!$_SESSION["admin-logged"]){
        header('Location:index.php');
    }

    include "database.php";

?>

<?php

    $page = "";

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    if($page == ""){
        $page = 1;
    }

    $resultCount = mysqli_query($con,"select count(user_id) from user");
    $rows_count = mysqli_fetch_array($resultCount);

    $user_count = $rows_count[0];

    $items_per_page = 10;
    $required_pages = ceil($user_count/$items_per_page); 

    $start = $items_per_page*$page -$items_per_page;
    $end = $items_per_page;

?>

<?php
    $row_list = array();
    $result = mysqli_query($con,"select*from user limit $start, $end");

    while($row = mysqli_fetch_array($result)){
        $row_list[] = $row;
    }

    $rows = $result->fetch_array();

?>

<?php
    $row;
    foreach($row_list as $row){}
?>

<?php 
    if(isset($_POST['form-update-user'])){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['ugender'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $propic = $_FILES['propic'];

        if($propic['name']!=""){

            // Uploading profile picture
            $target_dir = "resources/uploads/propics/users/";
            $file_name = rand(1,100000000000).$propic['name'];
            $target_file = $target_dir.basename($file_name);

            if(file_exists($target_dir.basename($row['propic']))){
                unlink($target_dir.basename($row['propic']));
                move_uploaded_file($propic['tmp_name'],$target_file);
            }

            // Update Data
            $query = "update user set fname='$fname',lname='$lname',birthday='$birthday',gender='$gender',mobile='$mobile',email='$email',propic='$file_name' where user_id=".$row['user_id'];

            mysqli_query($con,$query);

        }else{
            
            // Update Data
            $query = "update user set fname='$fname',lname='$lname',birthday='$birthday',gender='$gender',mobile='$mobile',email='$email' where user_id=".$row['user_id'];

            mysqli_query($con,$query);

        }

        header('Location: user.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body background="resources/img/background.jpg" style="background-size: 100%;">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div>
                    <?php
                        require "components/header/main-header.php";
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div style="background-color:#8B0000;color:white">
                    <h2 class="text-center">Users</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <table class="table table-boderless table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Birhday</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $index=$start+1;
                            foreach($row_list as $row){
                                echo '<tr>';
                                    echo '<th scope="row">'.$index.'</th>';
                                    echo '<td><img src="resources/uploads/propics/users/'.$row['propic'].'" style="border-radius:50%" weidth="50px" height="50px" /></td>';
                                    echo '<td>'.$row["fname"].' '.$row['lname'].'</td>';
                                    echo '<td>'.$row['birthday'].'</td>';
                                    echo '<td>'.$row['gender'].'</td>';
                                    echo '<td>'.$row['email'].'</td>';
                                    echo '<div class="float-right">';
                                        echo '<td>';
                                            echo '<button class="btn btn-warning" style="margin-right:10px" type="button" data-toggle="modal" data-target="#user-view-modal'.$row['user_id'].'">View</button>';
                                            echo '<button class="btn btn-success" style="margin-right:10px" type="button" data-toggle="modal" data-target="#user-update-modal'.$row['user_id'].'">Update</button>';
                                            echo '<button class="btn btn-danger" style="margin-right:10px" type="button" data-toggle="modal" data-target="#user-delete-modal'.$row['user_id'].'">Delete</button>';
                                        echo '</td>';
                                    echo '</div>';

                                    require "components/modals/user/user-view-modal.php";
                                    require "components/modals/user/user-update-modal.php";

                                echo '</tr>';
                                $index++; 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <nav>
                    <ul class="pagination"> 
                        <?php
                            for($i=1;$i<=$required_pages;$i++){
                                echo '<li class="page-item"><a class="page-link" href="user.php?page='.$i.'">'.$i.'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>

