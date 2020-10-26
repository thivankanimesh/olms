<?php 
    session_start();

    include "database.php";
?>

<?php 

    $row_list1 = array();

    $query1 = "select name from category";

    $result1 = mysqli_query($con,$query1);

    while($row1 = mysqli_fetch_array($result1)){
        $row_list1[] = $row1;
    }

    $row_list2 = array();

    $query3 = "select fname, lname from author";

    $result3 = mysqli_query($con,$query3);

    while($row2 = mysqli_fetch_array($result3)){
        $row_list2[] = $row2;
    }

    $row_list3 = array();

    $query4 = "select fname, lname from publisher";

    $result4 = mysqli_query($con,$query4);

    while($row3 = mysqli_fetch_array($result4)){
        $row_list3[] = $row3;
    }

?>

<?php 

    $row_list = array();

    if(isset($_POST['form-search'])){

        $q = $_POST['q'];
        $category_name = $_POST['category'];
        $author_name = $_POST['author'];
        $publisher_name = $_POST['publisher'];

        $author_name_array = array();
        $publisher_name_array = array();

        $author_name_array[] = explode(" ",$author_name,2);
        $publisher_name_array[] = explode(" ",$publisher_name,2);

        if($category_name == "-Select Category-" && $author_name == "-Select Author-" && $publisher_name == "-Select Publisher-"){
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where title like '%$q%' ";
        }else if($author_name == "-Select Author-" && $publisher_name == "-Select Publisher-") {
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where ebook.title like '%$q%' and category.name = '$category_name'";
        }else if($category_name == "-Select Category-" && $publisher_name == "-Select Publisher-"){
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where ebook.title like '%$q%' and (author.fname = '".$author_name_array[0][0]."' or author.lname = '".$author_name_array[0][1]."')";
        }else if($category_name == "-Select Category-" && $author_name == "-Select Author-"){
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where ebook.title like '%$q%' and (publisher.fname = '".$publisher_name_array[0][0]."' or publisher.lname = '".$publisher_name_array[0][1]."')";
        }else if($publisher_name == "-Select Publisher-"){
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where ebook.title like '%$q%' and category.name = '$category_name' and (author.fname = '".$author_name_array[0][0]."' or author.lname = '".$author_name_array[0][1]."')";
        }else if($author_name == "-Select Author-"){
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where ebook.title like '%$q%' and category.name = '$category_name' and (publisher.fname = '".$publisher_name_array[0][0]."' or publisher.lname = '".$publisher_name_array[0][1]."')";
        }else if($category_name == "-Select Category-"){
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where ebook.title like '%$q%' and (author.fname = '".$author_name_array[0][0]."' or author.lname = '".$author_name_array[0][1]."') and (publisher.fname = '".$publisher_name_array[0][0]."' or publisher.lname = '".$publisher_name_array[0][1]."')";
        }else {
            $query2 = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id where ebook.title like '%$q%' and category.name = '$category_name' and (author.fname = '".$author_name_array[0][0]."' or author.lname = '".$author_name_array[0][1]."') and (publisher.fname = '".$publisher_name_array[0][0]."' or publisher.lname = '".$publisher_name_array[0][1]."')";
        }

        $result2 = mysqli_query($con,$query2);

        while($row = mysqli_fetch_array($result2)){
            $row_list[] = $row;
        }

    }else {

        $query = "select ebook.* , category.name as category_name, author.fname as author_fname, author.lname as author_lname, publisher.fname as publisher_fname, publisher.lname as publisher_lname, seller.fname as seller_fname, seller.lname as seller_lname from ebook inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id inner join publisher on publisher.publisher_id = ebook.publisher_id inner join seller on seller.seller_id = ebook.seller_id";
        $result = mysqli_query($con,$query);

        while($row = mysqli_fetch_array($result)){
            $row_list[] = $row;
        }

    }

?>

<?php

    $page = 1;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    $result = mysqli_query($con,"select count(ebook_id) from ebook");
    $rows_array = mysqli_fetch_array($result);

    $ebook_count = $rows_array[0];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        function submitt(){

            var user_logged = <?php 
                        $user_logged = 0;
                        if(isset($_SESSION['user-logged'])){
                            $user_logged = 1;
                        }
                        echo $user_logged;
                    ?>;

            if(user_logged==1){
                return true;
            }
            else{
                alert("You're not logged in","Warning")
                return false;
            }
        }         
    </script>
</head>
<body>

    <div class="container">
            <?php 
                require "components/header/main-header.php";
            ?>
        <br />
        
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 text-center">
                    <form action="index.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label class="col-form-label" for="txt-search">Search :</label>
                            </div>
                            <div class="form-group col-md-2">
                                <input id="txt-search" class="form-control" name="q" type="text" placeholder="Search here..." />
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control btn btn-sm btn-light" name="category">
                                    <?php 
                                        echo '<option value="-Select Category-" selected>-Select Category-</option>';
                                        foreach($row_list1 as $row1){
                                            echo '<option value="'.$row1['name'].'">'.$row1['name'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control btn btn-sm btn-light" name="author">
                                    <?php 
                                        echo '<option value="-Select Author-" select>-Select Author-</option>';
                                        foreach($row_list2 as $row2){
                                            echo '<option value="'.$row2['fname'].' '.$row2['lname'].'">'.$row2['fname'].' '.$row2['lname'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control btn btn-sm btn-light" name="publisher">
                                    <?php 
                                        echo '<option value="-Select Publisher-" select>-Select Publisher-</option>';
                                        foreach($row_list3 as $row3){
                                            echo '<option value="'.$row3['fname'].' '.$row3['lname'].'">'.$row3['fname'].' '.$row3['lname'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input class="form-control btn btn-sm btn-outline-dark" style="font-size: 13px; border-radius: 12px" type="submit" name="form-search" value="Search" />
                            </div>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
        <br />

        <div class="container" style="min-height: 640px">
            <div class="row justify-content-center">
                <?php 
                    echo '<div class="card-deck justify-content-center">';
                        foreach($row_list as $row){
                            echo '<div class="col-sm-auto">';
                                echo '<div class="card mb-3" style="width:150px; height:280px">';
                                    echo '<div class="row">';
                                        echo '<div class="col" align="center">';
                                            echo '<img class="card-img-top" src="resources/uploads/sellers/ebooks/coverpic/'.$row['cover_pic'].'" height="120px" width="90px" >';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body" style="padding-bottom: 0px">';
                                        echo '<div class="row">';
                                            echo '<div class="col" align="center">';
                                                echo '<h6>'.$row['title'].'</h6>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="row">';
                                            echo '<div class="col" align="center">';
                                                echo '<h6 style="color: blue; font-weight: bold">';
                                                    echo 'Rs:'.$row['price'];
                                                echo '</h6>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-footer" style="background-color: white; border-color: white; padding-top: 1px">';
                                            echo '<div class="row">';
                                                echo '<div class="col" align="center" style="padding-bottom:2px">';
                                                    echo '<button class="btn btn-sm btn-warning btn-block" style="font-size: 10px; border-radius: 6px;" type="button" data-toggle="modal" data-target="#item-view-modal'.$row['ebook_id'].'">VIEW</button>';
                                                    require "components/modals/index/item-view-modal.php";
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="row">';
                                                echo '<div class="col" align="center">';
                                                    echo '<form action="shoppingcart.php" method="POST" onsubmit="submitt()">';
                                                        echo '<input class="btn btn-success btn-sm btn-block" style="font-size: 10px; border-radius: 6px;" name="form-add--shoppingcart-item" type="submit" value="ADD TO CART" />';
                                                        echo '<input type="hidden" name="ebook_id" value="'.$row['ebook_id'].'" />';
                                                        echo '<input type="hidden" name="page" value="'.$page.'" />';
                                                    echo '</form>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                ?>
            </div>
        </div>
        
        <?php 
            require "components/modals/dashboard/seller-register-modal.php";
            require "components/modals/dashboard/seller-login-modal.php";
            require "components/modals/dashboard/user-register-modal.php";
            require "components/modals/dashboard/user-login-modal.php";
        ?>
    </div> 
    <br />
    <br />
    <br />
    <footer style="background-color: #003320; height: 100px; width: 100%;">
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
                <p style="text-align: center; color: white; font-size: 10px;">© 2020 GrabAnyBook Pvt(Ltd). All Right Reserved</p>
            </div>
        </footer>
</body>
</html>