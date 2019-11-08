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

    $resultCount = mysqli_query($con,"select count(ebook_id) from ebook inner join admin on admin.admin_id = ebook.admin_id");
    $rows_count = mysqli_fetch_array($resultCount);

    $ebook_count = $rows_count[0];

    $items_per_page = 10;
    $required_pages = ceil($ebook_count/$items_per_page); 

    $start = $items_per_page*$page -$items_per_page;
    $end = $items_per_page;

?>

<?php
    $row_list = array();
    $result = mysqli_query($con,"select ebook.*, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname from ebook inner join admin on admin.admin_id = ebook.admin_id inner join author on ebook.author_id = author.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id limit $start, $end");

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

    if(isset($_POST['form-add-ebook'])){
        
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $author_id = $_POST['author_id'];
        $publisher_id = $_POST['publisher_id'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $coverpic = $_FILES['coverpic'];
        $pdf = $_FILES['pdf'];

        $coverpic_name;
        $pdf_name;
        
        if($coverpic['name']!=""){
            $target_dir = "resources/uploads/admins/admin$admin/ebooks/coverpic/";
            $file_name = rand(1,100000000000).$coverpic['name'];
            $coverpic_name = $file_name;
            $target_file = $target_dir.basename($file_name);
            if(!file_exists($target_file)){
                move_uploaded_file($coverpic['tmp_name'],$target_file);
            }
        }

        if($pdf['name']!=""){
            $target_dir = "resources/uploads/admins/admin$admin/ebooks/pdf/";
            $file_name = rand(1,100000000000).$pdf['name'];
            $pdf_name = $file_name;
            $target_file = $target_dir.basename($file_name);
            if(!file_exists($target_file)){
                move_uploaded_file($pdf['tmp_name'],$target_file);
            }
        }

        // Inserting Data
        $query = "insert into ebook (title,category_id,author_id,publisher_id,price,description,cover_pic,pdf_name,admin_id) values ('$title',$category_id,$author_id,$publisher_id,$price,'$description','$coverpic_name','$pdf_name',$admin)";
        mysqli_query($con,$query);

        header('Location:ebook.php?page='.$page);

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ebooks</title>
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
                    <h2 class="text-center">Ebooks</h2>
                </div>
            </div>
        </div>
        
        <div class="row" style="margin-top: 15px">
            <div class="col-sm">
                <div style="margin-bottom: 5px">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#ebook-add-modal">Add New</button>
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
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">Author</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $index=$start+1;
                            foreach($row_list as $row){
                                echo '<tr>';
                                    echo '<th scope="row">'.$index.'</th>';
                                    echo '<td><img src="resources/uploads/admins/admin'.$row['admin_id'].'/ebooks/coverpic/'.$row['cover_pic'].'" style="border-radius:50%" weidth="50px" height="50px" /></td>';
                                    echo '<td>'.$row["title"].'</td>';
                                    echo '<td>'.$row['category_id'].'</td>';
                                    echo '<td>'.$row['description'].'</td>';
                                    echo '<td>'.$row['author_id'].'</td>';
                                    echo '<td>'.$row['price'].'</td>';
                                    echo '<div class="float-right">';
                                        echo '<td>';
                                            echo '<button class="btn btn-warning" style="margin-right:10px" type="button" dapropicpropicpropicpropicta-toggle="modal" data-target="#user-view-modal'.$row['ebook_id'].'">View</button>';
                                            echo '<button class="btn btn-success" style="margin-right:10px" type="button" data-toggle="modal" data-target="#user-update-modal'.$row['ebook_id'].'">Update</button>';
                                            echo '<button class="btn btn-danger" style="margin-right:10px" type="button" data-toggle="modal" data-target="#user-delete-modal'.$row['ebook_id'].'">Delete</button>';
                                        echo '</td>';
                                    echo '</div>';

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
    <?php
        require "components/modals/ebook/ebook-add-modal.php";
    ?>
</body>
</html>

