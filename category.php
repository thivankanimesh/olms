<?php
    session_start();

    $admin_id;

    if(isset($_SESSION["admin-logged"])){
        $admin_id = $_SESSION["admin-logged"];
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

    $result = mysqli_query($con,"select count(category_id) from category inner join admin on admin.admin_id = category.admin_id");
    $rows_array = mysqli_fetch_array($result);

    $author_count = $rows_array[0];

    $items_per_page = 2;
    $required_pages = ceil($author_count/$items_per_page); 

    $start = $items_per_page*$page -$items_per_page;
    $end = $items_per_page;
?>

<?php
    $row_list = array();
    $result = mysqli_query($con,"select*from category where admin_id = $admin_id limit $start, $end");

    while($row = mysqli_fetch_array($result)){
        $row_list[] = $row;
    }
?>

<?php 

if(isset($_POST["form-add-category"])){

    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "insert into category (name,description,admin_id) values ('$name','$description',$admin_id)";

    mysqli_query($con,$query);

    header('Location:category.php?page='.$page);

}else if(isset($_POST["form-update-category"])){

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "update category set name='$name', description='$description' where category_id=$category_id";

    mysqli_query($con,$query);

    header('Location:category.php?page='.$page);

}else if(isset($_POST["form-delete-category"])){

    $category_id = $_POST['category_id'];

    $query = "delete from category where category_id=$category_id";

    mysqli_query($con,$query);

    header('Location:category.php?page='.$page);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authors</title>
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
                    <h2 class="text-center">Categories</h2>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 15px">
            <div class="col-sm">
                <div style="margin-bottom: 5px">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#category-add-modal">Add New</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $index=$start+1;
                            foreach($row_list as $row){
                                echo '<tr>';
                                    echo '<th scope="row">'.$index.'</th>';
                                    echo '<td>'.$row["name"].'</td>';
                                    echo '<td>'.$row['description'].'</td>';
                                        echo '<td class="float-right">';
                                            echo '<button class="btn btn-sm btn-warning" style="margin-right:10px" type="button" data-toggle="modal" data-target="#category-view-modal'.$row['category_id'].'">View</button>';
                                            echo '<button class="btn btn-sm btn-success" style="margin-right:10px" type="button" data-toggle="modal" data-target="#category-update-modal'.$row['category_id'].'">Update</button>';
                                            echo '<button class="btn btn-sm btn-danger" style="margin-right:10px" type="button" data-toggle="modal" data-target="#category-delete-modal'.$row['category_id'].'">Delete</button>';
                                        echo '</td>';

                                    require "components/modals/category/category-view-modal.php";
                                    require "components/modals/category/category-update-modal.php";
                                    require "components/modals/category/category-delete-modal.php";

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
                                echo '<li class="page-item"><a class="page-link" href="category.php?page='.$i.'">'.$i.'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php
        require "components/modals/category/category-add-modal.php";
    ?>
</body>
</html>
