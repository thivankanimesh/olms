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

    $query1 = "select shoppingcart.ebook_id, shoppingcart.user_id, ebook.price as ebook_price from shoppingcart inner join ebook on ebook.ebook_id = shoppingcart.ebook_id where user_id=".$user_id;

    $result1 = mysqli_query($con, $query1);

    $date = date("Y/m/d");

    while($row = mysqli_fetch_array($result1)){
        
        $query2 = "insert into purchasing_records (ebook_id,date,sold_price,user_id) values (".$row['ebook_id'].",'".$date."',".$row['ebook_price'].",".$row['user_id'].")";

        mysqli_query($con,$query2);

    }

    $query3 = "select shoppingcart.ebook_id, shoppingcart.user_id, ebook.price as ebook_price from shoppingcart inner join ebook on ebook.ebook_id = shoppingcart.ebook_id where user_id=".$user_id;

    $result3 = mysqli_query($con, $query3);

    while($row = mysqli_fetch_array($result3)){

        $query4 = "select * from purchased_ebooks where ebook_id=".$row['ebook_id']." and user_id=".$row['user_id']."";

        $result4 = mysqli_query($con,$query4);

        if(mysqli_num_rows($result4) == 0){

            $query5 = "insert into purchased_ebooks (ebook_id,user_id) values (".$row['ebook_id'].",".$row['user_id'].")";

            mysqli_query($con,$query5);

        }

    }

    $query6 = "truncate table shoppingcart";
    mysqli_query($con,$query6);

    unset($_SESSION["added-to-shoppingcart"]);

    header('Location:index.php');

?>