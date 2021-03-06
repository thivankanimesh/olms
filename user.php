<?php

    session_start();

    $seller_id;

    if(isset($_SESSION["seller-logged"])){
        $seller_id = $_SESSION["seller-logged"];
    }else{
        header('Location:index.php');
    }

    include "database.php";

?>

<?php

    $page = 1;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    $result = mysqli_query($con,"select count(user_id) from user");
    $rows_array = mysqli_fetch_array($result);

    $user_count = $rows_array[0];

    $items_per_page = 6;
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

            $target_dir_for_propic = "resources/uploads/propics/users/";
            $propic_name = rand(1,100000000000).$propic['name'];
            $target_propic = $target_dir_for_propic.basename($propic_name);

            unlink($target_dir_for_propic.basename($row['propic']));
            move_uploaded_file($propic['tmp_name'],$target_propic);

            $query = "update user set fname='$fname',lname='$lname',birthday='$birthday',gender='$gender',mobile='$mobile',email='$email',propic='$propic_name' where user_id=".$row['user_id'];

            mysqli_query($con,$query);

        }else{

            $query = "update user set fname='$fname',lname='$lname',birthday='$birthday',gender='$gender',mobile='$mobile',email='$email' where user_id=".$row['user_id'];

            mysqli_query($con,$query);

        }

        header('Location:user.php?page='.$page);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body background="resources/img/download.jpeg" style="background-size: 100%;">
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
                <div style="background-color:#003300;color:white">
                    <h2 class="text-center">Users</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <table class="table table-hover table-dark">
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
                                    echo '<td><img src="resources/uploads/propics/users/'.$row['propic'].'" style="border-radius:50%; width: 40px; height: 40px; position: relative; overflow: hidden;" weidth="35px" height="35px" /></td>';
                                    echo '<td>'.$row["fname"].' '.$row['lname'].'</td>';
                                    echo '<td>'.$row['birthday'].'</td>';
                                    echo '<td>'.$row['gender'].'</td>';
                                    echo '<td>'.$row['email'].'</td>';
                                    echo '<div class="float-right">';
                                        echo '<td>';
                                            echo '<button class="btn btn-sm btn-warning" style="margin-right:10px" type="button" data-toggle="modal" data-target="#user-view-modal'.$row['user_id'].'">View</button>';
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

