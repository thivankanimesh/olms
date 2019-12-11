<?php
    session_start();

    $user_id = $_SESSION["user-logged"];

    if(!$_SESSION["user-logged"]){
        header('Location:index.php');
    }

    include "database.php";
?>

<?php

    $page = 1;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    $result1 = mysqli_query($con,"select count(purchased_ebook_id) from purchased_ebooks where user_id=$user_id");
    $rows_array = mysqli_fetch_array($result1);

    $ebook_count = $rows_array[0];

    $items_per_page = 10;
    $required_pages = ceil($ebook_count/$items_per_page); 

    $start = $items_per_page*$page -$items_per_page;
    $end = $items_per_page;

?>

<?php 

    $query2 = "select ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title, ebook.description as ebook_description, ebook.cover_pic as ebook_cover_pic, ebook.pdf_name as ebook_pdf_name, category.name as category_name, author.fname as author_fname, author.lname as author_lname from purchased_ebooks inner join ebook on ebook.ebook_id = purchased_ebooks.ebook_id inner join category on category.category_id = ebook.category_id inner join author on author.author_id = ebook.author_id where user_id=$user_id limit $start, $end";

    $result2 = mysqli_query($con, $query2);

    $row_list = array();

    while($row = mysqli_fetch_array($result2)){
        $row_list[] = $row;
    }

?>

<?php 

    if(isset($_GET['download_pdf'])){

        $pdf_name_to_download = $_GET['pdf_name_to_download'];

        $file = "resources/uploads/admins/ebooks/pdf/$pdf_name_to_download";

        $file_type = filetype($file);

        $file_name = basename($file);
          
        header("Content-Type: ".$file_type);

        header ("Content-Length: ".filesize($file));

        header("Content-Disposition: attachment; filename=".$file_name);

        readfile($file);

    }else if(isset($_POST['form-delete-pdf'])){

        $ebook_ebook_id = $_POST['ebook_ebook_id'];

        $query3 = "delete from purchased_ebooks where ebook_id=$ebook_ebook_id and user_id=$user_id";

        mysqli_query($con,$query3);

        header('Location: account.php');

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body background="resources/img/download.jpeg" style="background-size: 100%;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div style="margin-bottom: 10px">
                    <?php 
                    require "components/header/main-header.php";
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <table class="table table-boderless table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"></th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Author</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $index=$start+1;
                            foreach($row_list as $row){
                                echo '<tr>';
                                    echo '<th scope="row">'.$index.'</th>';
                                    echo '<td><img src="resources/uploads/admins/ebooks/coverpic/'.$row['ebook_cover_pic'].'" style="border-radius:50%" weidth="50px" height="50px" /></td>';
                                    echo '<td>'.$row["ebook_title"].'</td>';
                                    echo '<td>'.$row['ebook_description'].'</td>';
                                    echo '<td>'.$row['category_name'].'</td>';
                                    echo '<td>'.$row['author_fname'].' '.$row['author_lname'].'</td>';
                                    echo '<div class="float-right">';
                                        echo '<td>';
                                            echo '<div class="row">';
                                                echo '<div class="col">';
                                                    echo '<form action="viewpdf.php" method="POST">';
                                                        echo '<input type="hidden" name="ebook_pdf_name" value="'.$row['ebook_pdf_name'].'" />';
                                                        echo '<input name="form-view-pdf" class="btn btn-warning" style="margin-right:10px" type="submit" value="View" />';
                                                    echo '</form>';
                                                echo '</div>';
                                                echo '<div class="col">';
                                                    echo '<form action="account.php" method="GET">
                                                    <input type="hidden" name="pdf_name_to_download" value="'.$row['ebook_pdf_name'].'" />
                                                    <input name="download_pdf" class="btn btn-success" style="margin-right:10px" type="submit" value="Download" />
                                                </form>';
                                                echo '</div>';
                                                echo '<div class="col">';
                                                echo '<button class="btn btn-danger" style="margin-right:10px" type="button" data-toggle="modal" data-target="#pdf-delete-modal'.$row['ebook_ebook_id'].'">Delete</button>';
                                                echo '</div>';
                                            echo '</div>';  
                                        echo '</td>';
                                    echo '</div>';
                                    require "components/modals/account/pdf-delete-modal.php";
                                echo '</tr>';
                                $index++; 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>