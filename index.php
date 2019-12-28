<?php 
    session_start();
?>

<?php 
    require_once("database.php");
?>

<?php 

    $row_list1 = array();
    $row_list2 = array();
    $row_list3 = array();

    $stmt = $con->prepare("select name from category");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $stmt->fetch()){
        $row_list1[] = $row;
    }

    $stmt = $con->prepare("select fname, lname from author");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $stmt->fetch()){
        $row_list2[] = $row;
    }

    $stmt = $con->prepare("select fname, lname from publisher");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $stmt->fetch()){
        $row_list3[] = $row;
    }

?>

<?php 

    $row_list = array();

    if(isset($_POST['form-search'])){

        $q = '%'.$_POST['q'].'%';
        $category_name = $_POST['category'];
        $author_name = $_POST['author'];
        $publisher_name = $_POST['publisher'];

        $author_name_array = array();
        $publisher_name_array = array();

        $author_name_array[] = explode(" ",$author_name,2);
        $publisher_name_array[] = explode(" ",$publisher_name,2);

        if($category_name == "-Select Category-" && $author_name == "-Select Author-" && $publisher_name == "-Select Publisher-"){
            $query2 = "select*from ebook where title like (:q)";
            $stmt = $con->prepare($query2);
            $stmt->bindParam( ':q',$q, PDO::PARAM_STR);
        }else if($author_name == "-Select Author-" && $publisher_name == "-Select Publisher-") {
            $query2 = "select*from ebook inner join category on category.category_id = ebook.category_id where ebook.title like (:q) and category.name = (:category_name)";
            $stmt = $con->prepare($query2);
            $stmt->bindParam(':q',$q,PDO::PARAM_STR);
            $stmt->bindParam(':category_name',$category_name,PDO::PARAM_STR);
        }else if($category_name == "-Select Category-" && $publisher_name == "-Select Publisher-"){
            $query2 = "select*from ebook inner join author on author.author_id = ebook.author_id where ebook.title like (:q) and (author.fname = (:author_fname) or author.lname = (:author_lname))";
            $stmt = $con->prepare($query2);
            $stmt->bindParam(':q',$q,PDO::PARAM_STR);
            $stmt->bindParam(':author_fname',$author_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':author_lname',$author_name_array[0][1],PDO::PARAM_STR);
        }else if($category_name == "-Select Category-" && $author_name == "-Select Author-"){
            $query2 = "select*from ebook inner join publisher on publisher.publisher_id = ebook.publisher_id where ebook.title like (:q) and (publisher.fname = (:publisher_fname) or publisher.lname = (:publisher_lname))";
            $stmt = $con->prepare($query2);
            $stmt->bindParam(':q',$q,PDO::PARAM_STR);
            $stmt->bindParam(':publisher_fname',$publisher_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':publisher_lname',$publisher_name_array[0][1],PDO::PARAM_STR);
        }else if($publisher_name == "-Select Publisher-"){
            $query2 = "select*from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id where ebook.title like (:q) and category.name = (:category_name) and (author.fname = (:author_fname) or author.lname = (:author_lname))";
            $stmt = $con->prepare($query2);
            $stmt->bindParam(':q',$q,PDO::PARAM_STR);
            $stmt->bindParam(':category_name',$category_name,PDO::PARAM_STR);
            $stmt->bindParam(':author_fname',$author_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':author_lname',$author_name_array[0][1],PDO::PARAM_STR);
        }else if($author_name == "-Select Author-"){
            $query2 = "select*from ebook inner join category on category.category_id = ebook.category_id inner join publisher on publisher.publisher_id = ebook.publisher_id where ebook.title like (:q) and category.name = (:category_name) and (publisher.fname = (:publisher_fname) or publisher.lname = (:publisher_lname))";
            $stmt = $con->prepare($query2);
            $stmt->bindParam(':q',$q,PDO::PARAM_STR);
            $stmt->bindParam(':category_name',$category_name,PDO::PARAM_STR);
            $stmt->bindParam(':publisher_fname',$publisher_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':publisher_lname',$publisher_name_array[0][1],PDO::PARAM_STR);
        }else if($category_name == "-Select Category-"){
            $query2 = "select*from ebook inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id where ebook.title like (:q) and (author.fname = (:author_fname) or author.lname = (:author_lname)) and (publisher.fname = (:publisher_fname) or publisher.lname = (:publisher_lname))";
            $stmt = $con->prepare($query2);
            $stmt->bindParam(':q',$q,PDO::PARAM_STR);
            $stmt->bindParam(':author_fname',$author_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':author_lname',$author_name_array[0][1],PDO::PARAM_STR);
            $stmt->bindParam(':publisher_fname',$publisher_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':publisher_lname',$publisher_name_array[0][1],PDO::PARAM_STR);
        }else {
            $query2 = "select*from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id where ebook.title like (:q) and category.name = (:category_name) and (author.fname = (:author_fname) or author.lname = (:author_lname)) and (publisher.fname = (:publisher_fname) or publisher.lname = (:publisher_lname))";
            $stmt = $con->prepare($query2);
            $stmt->bindParam(':q',$q,PDO::PARAM_STR);
            $stmt->bindParam(':category_name',$category_name,PDO::PARAM_STR);
            $stmt->bindParam(':author_fname',$author_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':author_lname',$author_name_array[0][1],PDO::PARAM_STR);
            $stmt->bindParam(':publisher_fname',$publisher_name_array[0][0],PDO::PARAM_STR);
            $stmt->bindParam(':publisher_lname',$publisher_name_array[0][1],PDO::PARAM_STR);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()){
            $row_list[] = $row;
        }

    }else {

        $query = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()){
            $row_list[] = $row;
        }

    }

?>

<?php

    $page = 1;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    $stmt = $con->prepare("select count(ebook_id) from ebook");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows_array = array();
    while($row = $stmt->fetch()){
        $rows_array = $row;
    }

    $ebook_count = $rows_array['count(ebook_id)'];

    $items_per_page = 10;
    $required_pages = ceil($ebook_count/$items_per_page); 

    $start = $items_per_page*$page -$items_per_page;
    $end = $items_per_page;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Libary System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    <?php 
                        require "components/header/main-header.php";
                    ?>
                </div>
            </div>
        </div>
        <br />
        
        <div class="row">
            <div class="col-12 text-center">
                <form action="index.php" method="POST">
                    <div class="row">
                        <div class="col-sm-auto">
                            <p>Search :</p>
                        </div>
                        <div class="col-sm-auto">
                            <input name="q" type="text" placeholder="Search here..." />
                        </div>
                        <div class="col-sm-auto">
                            <select class="btn btn-sm btn-light" name="category">
                                <?php 
                                    echo '<option value="-Select Category-" selected>-Select Category-</option>';
                                    foreach($row_list1 as $row1){
                                        echo '<option value="'.$row1['name'].'">'.$row1['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-auto">
                            <select class="btn btn-sm btn-light" name="author">
                                <?php 
                                    echo '<option value="-Select Author-" select>-Select Author-</option>';
                                    foreach($row_list2 as $row2){
                                        echo '<option value="'.$row2['fname'].' '.$row2['lname'].'">'.$row2['fname'].' '.$row2['lname'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-auto">
                            <select class="btn btn-sm btn-light" name="publisher">
                                <?php 
                                    echo '<option value="-Select Publisher-" select>-Select Publisher-</option>';
                                    foreach($row_list3 as $row3){
                                        echo '<option value="'.$row3['fname'].' '.$row3['lname'].'">'.$row3['fname'].' '.$row3['lname'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-auto">
                            <input class="btn btn-sm btn-dark" type="submit" name="form-search" value="Search" />
                        </div>
                    </div>   
                </form>
            </div>
        </div>
        <br />

        <?php 

            $count = (int)1;

            echo '<div class="row">';
                foreach($row_list as $row){
            
                    echo '<div class="col-sm-2">';
                        echo '<div class="card" style="width:150px;height:280px">';
                            echo '<div class="row">';
                                echo '<div class="col" align="center">';
                                    echo '<img class="card-img-top" src="resources/uploads/admins/ebooks/coverpic/'.$row['cover_pic'].'" height="120px" width="90px" >';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="card-body">';
                                echo '<div class="row">';
                                    echo '<div class="col" align="center">';
                                        echo '<h5>'.$row['title'].'</h5>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="row">';
                                    echo '<div class="col" align="center">';
                                        echo '<h6>';
                                            echo 'Rs:'.$row['price'];
                                        echo '</h6>';
                                    echo '</div>';
                                    echo '<div class="col" align="center" style="padding-bottom:2px">';
                                        echo '<button class="btn btn-warning btn-sm btn-block" type="button" data-toggle="modal" data-target="#item-view-modal'.$row['ebook_id'].'">View</button>';
                                        require "components/modals/index/item-view-modal.php";
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="row">';
                                    echo '<div class="col" align="center">';
                                        echo '<form action="shoppingcart.php" method="POST">';
                                            echo '<input class="btn btn-success btn-sm btn-block" name="form-add--shoppingcart-item" type="submit" value="Add To Cart" />';
                                            echo '<input type="hidden" name="ebook_id" value="'.$row['ebook_id'].'" />';
                                            echo '<input type="hidden" name="page" value="'.$page.'" />';
                                        echo '</form>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                    if($count%2==(int)0){
                        echo '</div>';
                        echo '<div class="row">';
                    }

                    $count++;
                }
            echo '</div>';
           
        ?>
        
        <?php 
            require "components/modals/dashboard/admin-register-modal.php";
            require "components/modals/dashboard/admin-login-modal.php";
            require "components/modals/dashboard/user-register-modal.php";
            require "components/modals/dashboard/user-login-modal.php";
        ?>
    </div> 
    <br />
    <footer style="background-color: blue; height: 100px; width: 100%;">
            <div class="container">
                <br />
                <div class="row">
                    <div class="col-sm" style="text-align: center;">
                        <a href="#" style="color: white; text-decoration: none;">About Us</a>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <a href="#" style="color: white; text-decoration: none;">Contacts</a>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <a href="#" style="color: white; text-decoration: none;">Terms of Service</a>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <a href="#" style="color: white; text-decoration: none;">Privacy Policy</a>
                    </div>
                    <div class="col-sm" style="text-align: center;">
                        <a href="#" style="color: white; text-decoration: none;">Blog</a>
                    </div>  
                    <div class="col-sm" style="text-align: center;">
                        <a href="#" style="color: white; text-decoration: none;">FAQ</a>
                    </div>
                </div>
                <hr />
                <p style="text-align: center; color: white; font-size: 10px;">© 2019 Online Libary System Pvt(Ltd). All Right Reserved</p>
            </div>
        </footer>
</body>
</html>