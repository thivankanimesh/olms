<?php
    include "database.php";

    if(isset($_SESSION["user-logged"])){
        $query = "select count(shoppingcart_item_id) from shoppingcart where user_id=".$_SESSION["user-logged"];

        $shoppingcart_item_result = mysqli_query($con,$query);
        $shoppingcart_item_array = mysqli_fetch_array($shoppingcart_item_result);
        $shoppingcart_item_count = $shoppingcart_item_array[0];
    }
?>

<div class="row" style="background-color: #F0EFEF; padding-top: 10px; padding-bottom: 15px;">
    <div class="col-md-1 align-self-center">
        <div class="row justify-content-center">
            <img src="resources/img/logo.jpg" height="40px" width="40px" />
        </div>
    </div>
    <div class="col-md-2 align-self-center">
        <div class="row justify-content-center">
            <a href="index.php" style="font-size: 25px; font-weight: bold; color:rgb(0, 0, 0); text-decoration: none;">GrabAnyBook</a>
        </div>
    </div>
    <div class="col-md-9 align-self-center">
        <div class="row justify-content-end">
            <?php
                if(isset($_SESSION["user-logged"])){
                    if(isset($_SESSION["added-to-shoppingcart"])){
                        echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                                <div class="row justify-content-center">
                                    <form method="POST" action="shoppingcart.php">
                                        <button name="form-main-header-shoppingcart" class="btn btn-sm btn-warning" style="margin-right: 5px" type="submit">
                                            <div class="fa fa-shopping-cart"></div> 
                                            '.$shoppingcart_item_count.'
                                        </button>
                                    </form>
                                </div>
                            </div>';
                    }
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <form action="account.php" method="POST">
                                    <button class="btn btn-sm btn-primary" style="font-size: 13px; border-radius: 8px; height: 30px; width: 120px;" name="form-main-header-account" type="submit">
                                        Account
                                    </button>
                                </form>
                            </div>
                        </div>';
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <form action="user-logout.php" method="POST">
                                    <button class="btn btn-sm btn-danger" style="font-size: 13px; border-radius: 8px; height: 30px; width: 120px;" name="form-main-header-user-logout" type="submit">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>';
                }else if(isset($_SESSION["seller-logged"])){
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <form action="dashboard.php" method="POST">
                                    <button class="btn btn-sm btn-primary" style="font-size: 13px; border-radius: 8px; height: 30px; width: 120px;" name="form-main-header-seller-dashboard" type="submit">
                                        Seller Dashboard
                                    </button>
                                </form>
                            </div>
                        </div>';
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <form action="seller-logout.php" method="POST">
                                    <button class="btn btn-sm btn-danger" style="font-size: 13px; border-radius: 8px; height: 30px; width: 120px;" name="form-main-header-seller-logout" type="submit">
                                        Seller Logout
                                    </button>
                                </form>
                            </div>
                        </div>';
                }else{
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <button class="btn btn-sm btn-danger" style="font-size: 13px; border-radius: 8px; height: 30px; width: 104px;" type="button" data-toggle="modal" data-target="#seller-register-modal">
                                    Seller Register
                                </button>
                            </div>
                        </div>';
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <button class="btn btn-sm btn-danger" style="font-size: 13px; border-radius: 8px; height: 30px; width: 104px;" type="button" data-toggle="modal" data-target="#seller-login-modal">
                                    Seller Login
                                </button>
                            </div>
                        </div>';
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <button class="btn btn-sm btn-danger" style="font-size: 13px; border-radius: 8px; height: 30px; width: 104px;" type="button" data-toggle="modal" data-target="#user-register-modal">
                                    User Register
                                </button>
                            </div>
                        </div>';
                    echo '<div class="col-md-auto align-self-center" style="margin: 2px;">
                            <div class="row justify-content-center">
                                <button class="btn btn-sm btn-danger" style="font-size: 13px; border-radius: 8px; height: 30px; width: 104px;" type="button" data-toggle="modal" data-target="#user-login-modal">
                                    User Login
                                </button>
                            </div>
                        </div>'; 
                }
            ?>
        </div>
    </div>
</div>


      



