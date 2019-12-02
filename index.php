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

?>

<?php 

    $row_list = array();

    if(isset($_POST['form-search'])){

        $q = $_POST['q'];
        $category_name = $_POST['category'];

        if($category_name == "All"){
            $query2 = "select*from ebook where title like '%$q%' ";
        }else {
            $query2 = "select*from ebook inner join category on category.category_id = ebook.category_id where ebook.title like '%$q%' and category.name like '$category_name'";
        }

        $result2 = mysqli_query($con,$query2);

        while($row = mysqli_fetch_array($result2)){
            $row_list[] = $row;
        }

    }else {

        $query = "select*from ebook";
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
            <div class="col">
                <form action="index.php" method="POST">
                    Search :
                    <input name="q" type="text" />
                    <select name="category">
                        <?php 
                            echo '<option value="All" selected>All</option>';
                            foreach($row_list1 as $row1){
                                echo '<option value="'.$row1['name'].'">'.$row1['name'].'</option>';
                            }
                        ?>
                    </select>
                    <input type="submit" name="form-search" value="Search" />
                </form>
            </div>
        </div>
        <br />

        <?php 

            $count = (int)1;

            echo '<div class="row">';
                foreach($row_list as $row){
            
                    echo '<div class="col-sm-2">';
                        echo '<div class="card" style="width:160px;height:250px">';
                            echo '<div class="row">';
                                echo '<div class="col" align="center">';
                                    echo '<img class="card-img-top" src="resources/uploads/admins/ebooks/coverpic/'.$row['cover_pic'].'" height="120px" width="100px" >';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="card-body">';
                                echo '<div class="row">';
                                    echo '<div class="col" align="center">';
                                        echo $row['title'];
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="row">';
                                    echo '<div class="col" align="center">';
                                        echo '<h6>';
                                            echo $row['price'];
                                        echo '</h6>';
                                    echo '</div>';
                                    echo '<div class="col" align="center">';
                                        echo '<input class="btn btn-warning btn-sm" type="button" value="View" />';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="row">';
                                    echo '<div class="col" align="center">';
                                        echo '<form action="shoppingcart.php" method="POST">';
                                            echo '<input class="btn btn-success btn-sm" name="form-add--shoppingcart-item" type="submit" value="Add To Cart" />';
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