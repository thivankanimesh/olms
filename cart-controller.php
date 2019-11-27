<?php 
    session_start();

    include "database.php";
?>

<?php

    if(isset($_POST['add-to-cart'])){

        if(isset($_SESSION["user-logged"])){

            $ebook_id = $_POST['ebook_id'];
            $user_id = $_SESSION["user-logged"];

            $query = "insert into cart (ebook_id,user_id) values ($ebook_id,$user_id)";

            mysqli_query($con,$query);

            $_SESSION["added-to-cart"] = $user_id;
            
            header("Location:index.php");

        }else{
            header("Location:user-login-view.php");
        }

    }

?>


</body>
</html>