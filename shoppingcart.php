<?php
    session_start();

    if(isset($_SESSION["user-logged"])){
        $user_id = $_SESSION["user-logged"];
    }else{
        header('Location:index.php');
        exit();
    }
?>

<?php 
    include "database.php";
?>

<?php 

    if(isset($_POST["form-add--shoppingcart-item"])){

        $ebook_id = $_POST['ebook_id'];
        $user_id = $_SESSION["user-logged"];

        $query = "select * from shoppingcart where ebook_id = $ebook_id and user_id = $user_id";

        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result) == 0){

            $query = "insert into shoppingcart (ebook_id,user_id) values ($ebook_id,$user_id)";

            mysqli_query($con,$query);

        }

        $_SESSION["added-to-shoppingcart"] = $user_id;
        
        header("Location:index.php");

    } else if (isset($_POST['form-remove-shoppingcart-item'])){

        $shoppingcart_item_id = $_POST["shoppingcart_item_id"];

        $query = "delete from shoppingcart where shoppingcart_item_id=".$shoppingcart_item_id;

        mysqli_query($con,$query);

        header('Location:shoppingcart.php');

    }

?>

<?php

    $row_list = array();

    $result = mysqli_query($con,"select shoppingcart.*, ebook.title as ebook_title, ebook.cover_pic as ebook_cover_pic, ebook.price as ebook_price from shoppingcart inner join ebook on ebook.ebook_id = shoppingcart.ebook_id where user_id=".$user_id);
    
    while($row = mysqli_fetch_array($result)){
        $row_list[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
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
                <div style="background-color:#8B0000;color:white">
                    <h2 class="text-center">Shopping Cart</h2>
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
                            <th scope="col">eBook Name</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $index=(int)1;
                            foreach($row_list as $row){
                                echo '<tr>';
                                    echo '<th scope="row">'.$index.'</th>';
                                    echo '<td><img src="resources/uploads/sellers/ebooks/coverpic/'.$row['ebook_cover_pic'].'" style="border-radius:50%" weidth="50px" height="50px" /></td>';
                                    echo '<td>'.$row["ebook_title"].'</td>';
                                    echo '<td>'.$row['ebook_price'].'</td>';
                                    echo '<div class="float-right">';
                                        echo '<td>';
                                            echo '<button class="btn btn-sm btn-danger" style="margin-right:10px" type="button" data-toggle="modal" data-target="#shoppingcart-item-remove-modal'.$row['shoppingcart_item_id'].'">Remove</button>';
                                        echo '</td>';
                                    echo '</div>';

                                    require "components/modals/shoppingcart/shoppingcart-item-remove-modal.php";

                                echo '</tr>';
                                $index++; 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

<?php 

    // Getting total amount to pay

    $query = "select sum(ebook.price) as total_amount from shoppingcart inner join ebook on ebook.ebook_id = shoppingcart.ebook_id";
    $result = mysqli_query($con, $query);

    $total_amount = mysqli_fetch_array($result)[0];

?>

        <div class="row justify-content-end">
            <div class="col-md-3 offset-md-3">
                <?php 
                    echo '<p style="color:white; background-color:#343a40; padding:5px">Total : '.$total_amount.'<p>';
                ?>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-3 offset-md-3">
                    <?php 
                        echo '<input name="total" type="hidden" value="'.$total_amount.'" />';
                    ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Checkout</button>
                    <?php 
                        require "components/modals/shoppingcart/shoppingcart-paywithpaypal-modal.php";
                    ?>
            </div>
        </div>
    </div>
</body>
</html>