<?php
    include "database.php";

    if(isset($_SESSION["user-logged"])){
        $query = "select count(cart_item_id) from cart where user_id=".$_SESSION["user-logged"];

        $cart_item_result = mysqli_query($con,$query);
        $cart_item_array = mysqli_fetch_array($cart_item_result);
        $cart_item_count = $cart_item_array[0];
    }
?>

<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Online Libary System</a>
    <form class="form-inline">
        <?php
        if(isset($_SESSION["user-logged"])){
                    echo '<div class="form-group">';
                        if(isset($_SESSION["added-to-cart"])){
                            echo '<a href="shoppingcart.php" class="btn btn-primary" style="margin-right: 5px" type="button">Shopping Cart : '.$cart_item_count.'</a>';
                        }
                        echo '<a href="account.php" class="btn btn-primary" style="margin-right: 5px" type="button">Account</a>';
                        echo '<a href="user-logout.php" class="btn btn-danger" type="button">Logout</a>';
                    echo '</div>';
        }else if(isset($_SESSION["admin-logged"])){
                    echo '<div class="form-group">';
                        echo '<a href="dashboard.php" class="btn btn-primary" style="margin-right: 5px" type="button">Admin Dashboard</a>';
                        echo '<a href="admin-logout.php" class="btn btn-danger" type="button">Admin Logout</a>';
                    echo '</div>';
        }else{
                echo '<button type="button" class="btn btn-danger" style="margin-right: 5px" data-toggle="modal" data-target="#admin-register-modal">Admin Register</button>';
                echo '<button type="button" class="btn btn-danger" style="margin-right: 5px" data-toggle="modal" data-target="#admin-login-modal">Admin Login</button>';
                echo '<button type="button" class="btn btn-danger" style="margin-right: 5px" data-toggle="modal" data-target="#user-register-modal">Register</button>';
                echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#user-login-modal">Login</button>';
            }
        ?>
    </form>
</nav>


      



