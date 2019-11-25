<?php 
    session_start();

    include "database.php";
?>

<?php 

    $row_list = array();

    $query = "select*from ebook";
    $result = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($result)){
        $row_list[] = $row;
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
                                        echo '<input class="btn btn-success btn-sm" type="button" value="Add To Cart" />';
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