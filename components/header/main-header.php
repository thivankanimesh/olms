<?php
    include "database.php";

    if(isset($_SESSION["user-logged"])){
        $query = "select count(shoppingcart_item_id) from shoppingcart where user_id=".$_SESSION["user-logged"];

        $shoppingcart_item_result = mysqli_query($con,$query);
        $shoppingcart_item_array = mysqli_fetch_array($shoppingcart_item_result);
        $shoppingcart_item_count = $shoppingcart_item_array[0];
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="resources/img/logo.jpg" height="40px" width="40px" />
        <a class="navbar-brand" href="index.php" style="font-size: 25px; font-weight: bold; color:rgb(0, 0, 0);">Online Library System</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav align-items-end ml-auto">
                <?php
                if(isset($_SESSION["user-logged"])){
                            if(isset($_SESSION["added-to-shoppingcart"])){
                                echo '<li class="nav-item"><form method="POST" action="shoppingcart.php"><button name="form-main-header-shoppingcart" class="btn btn-sm btn-primary" style="margin-right: 5px" type="submit"><i class="fa fa-shopping-cart"></i> '.$shoppingcart_item_count.'</button></form></li>';
                            }
                            echo '<li class="nav-item"><form action="account.php" method="POST"><button name="form-main-header-account" class="btn btn-sm btn-primary" style="margin-right: 5px; border-radius: 10px;" type="submit">Account</button></form></li>';
                            echo '<li class="nav-item"><form action="user-logout.php" method="POST"><button name="form-main-header-user-logout" class="btn btn-sm btn-danger" style="margin-right: 5px; border-radius: 10px;" type="submit">Logout</button></form></li>';
                    
                }else if(isset($_SESSION["seller-logged"])){
                        echo '<li class="nav-item"><form action="dashboard.php" method="POST"><button name="form-main-header-seller-dashboard" class="btn btn-sm btn-primary" style="margin-right: 5px; border-radius: 10px;" type="submit">Seller Dashboard</button></form></li>';
                        echo '<li class="nav-item"><form action="seller-logout.php" method="POST"><button name="form-main-header-seller-logout" class="btn btn-sm btn-danger" style="margin-right: 5px; border-radius: 10px;" type="submit">Seller Logout</button></form></li>';
                
                }else{
                        echo '<li class="nav-item"><button type="button" class="btn btn-sm btn-danger" style="margin-right: 5px; border-radius: 10px; height: 30px;" data-toggle="modal" data-target="#seller-register-modal">Seller Register</button></li>';
                        echo '<li class="nav-item"><button type="button" class="btn btn-sm btn-danger" style="margin-right: 5px; border-radius: 10px; height: 30px;" data-toggle="modal" data-target="#seller-login-modal">Seller Login</button></li>';
                        echo '<li class="nav-item"><button type="button" class="btn btn-sm btn-danger" style="margin-right: 5px; border-radius: 10px; height: 30px;" data-toggle="modal" data-target="#user-register-modal">User Register</button></li>';
                        echo '<li class="nav-item"><button type="button" class="btn btn-sm btn-danger" style="margin-right: 5px; border-radius: 10px; height: 30px;" data-toggle="modal" data-target="#user-login-modal">User Login</button></li>';
                    
                    }
                ?>
            </ul>
    </div>
</nav>


      



