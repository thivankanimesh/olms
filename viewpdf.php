<?php
    session_start();

    $user_id = $_SESSION["user-logged"];

    if(!$_SESSION["user-logged"]){
        header('Location:index.php');
    }

    include "database.php";
?>

<?php 

    if(isset($_POST['form-view-pdf'])){

        $ebook_pdf_name = $_POST['ebook_pdf_name']; 

        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=$ebook_pdf_name");
        readfile("resources/uploads/admins/ebooks/pdf/$ebook_pdf_name");

    }

?>