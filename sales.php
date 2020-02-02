<?php

    session_start();

    $seller_id;

    if(isset($_SESSION["seller-logged"]) && (isset($_POST['from-form-pagination']) || isset($_POST['from-form-dashboard']))){
        $seller_id = $_SESSION["seller-logged"];
    }else if(isset($_SESSION["seller-logged"]) && (!isset($_POST['from-form-pagination']) || !isset($_POST['from-form-dashboard']))){
        header('Location:dashboard.php');
    }else{
        header('Location:index.php');
    }

    include "database.php";

?>

<?php 

    $year = date("Y");
    $month = date("m");
    $date = date("d");

    // This codes for pagination

    $page = 1;
    $from = "";

    if(isset($_POST['from-form-pagination'])){
        $page = $_POST['page'];
        $from = $_POST['from'];
    }else if(isset($_POST['from-form-dashboard'])){
        $from = $_POST['from'];
    }

    if(strcmp($from,"form-this-year-sales")==0){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year%' and seller_id = $seller_id");
        
    }else if(strcmp($from,"form-this-month-sales")==0){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month%' and seller_id = $seller_id");
        
    }else if(strcmp($from,"form-today-sales")==0){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month/$date' and seller_id = $seller_id");
        
    }else if(strcmp($from,"form-total-sales")==0){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where seller_id = $seller_id");
        
    }else{
        header('Location:dashboard.php');
    }

    $rows_array2 = mysqli_fetch_array($result2);

    $sales_count = $rows_array2[0];

    $items_per_page = 6;
    $required_pages = ceil($sales_count/$items_per_page); 

    $start = $items_per_page*$page -$items_per_page;
    $end = $items_per_page;


    // This is for retriveing data
    $row_list1 = array();

    $title = "";
    if(strcmp($from,"form-this-year-sales")==0){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title, ebook.cover_pic as ebook_cover_pic from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year%' and seller_id = $seller_id limit $start, $end");
        $title = "Yearly Sales";

    }else if(strcmp($from,"form-this-month-sales")==0){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title, ebook.cover_pic as ebook_cover_pic from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month%' and seller_id = $seller_id limit $start, $end");
        $title = "Monthly Sales";

    }else if(strcmp($from,"form-today-sales")==0){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title, ebook.cover_pic as ebook_cover_pic from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month/$date%' and seller_id = $seller_id limit $start, $end");
        $title = "Today Sales";

    }else if(strcmp($from,"form-total-sales")==0){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title, ebook.cover_pic as ebook_cover_pic from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where seller_id = $seller_id limit $start, $end");
        $title = "Total Sales";

    }else {
        header('Location:dashboard.php');
    }

    while($row1 = mysqli_fetch_array($result3)){
        $row_list1[] = $row1;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales</title>
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
                <div style="background-color:#003300;color:white">
                    <?php
                        echo '<h2 class="text-center">'.$title.'</h2>';
                    ?>
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
                            <th scope="col">Name</th>
                            <th scope="col">Sales</th>
                            <th scope="col">Income</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 

                                $total_income = 0;

                                $index=$start+1;
                                foreach($row_list1 as $row){

                                    if(strcmp($from,"form-this-year-sales")==0){

                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id), sum(purchasing_records.sold_price) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and purchasing_records.date like '$year%' and ebook.seller_id=".$seller_id."");
                                
                                    }else if(strcmp($from,"form-this-month-sales")==0){
                                
                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id), sum(purchasing_records.sold_price) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and purchasing_records.date like '$year/$month%' and ebook.seller_id=".$seller_id."");
                                
                                    }else if(strcmp($from,"form-today-sales")==0){
                                
                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id), sum(purchasing_records.sold_price) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and purchasing_records.date like '$year/$month/$date%' and ebook.seller_id=".$seller_id."");
                                
                                    }else if(strcmp($from,"form-total-sales")==0){
                                
                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id), sum(purchasing_records.sold_price) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and ebook.seller_id=".$seller_id."");
                                
                                    }else {
                                        header('Location:dashboard.php');
                                    }

                                    $data4 = mysqli_fetch_array($result4);

                                    $total_income = $total_income + $data4[1];
                                
                                    echo '
                                        <tr>
                                            <td>'.$index.'</td>
                                            <td><img src="resources/uploads/sellers/ebooks/coverpic/'.$row['ebook_cover_pic'].'" style="border-radius:50%; width: 40px; height: 40px; position: relative; overflow: hidden;" weidth="35px" height="35px" /></td>
                                            <td>'.$row['ebook_title'].'</td>
                                            <td>'.$data4[0].'</td>
                                            <td>'.$data4[1].'</td>
                                        </tr>
                                    ';
                                    $index++;
                                }
                            ?>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo 'Total Income : '?></td>
                            <td>
                                <?php echo $total_income?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <nav>
                    <ul class="pagination"> 
                        <?php
                            for($i=1;$i<=$required_pages;$i++){
                                echo '<form action="sales.php" method="POST">
                                        <li class="page-item"><button name="from-form-pagination" type="submit" class="page-link">'.$i.'</button></li>
                                        <input type="hidden" name="page" value="'.$i.'" />
                                        <input type="hidden" name="from" value="'.$from.'" />
                                    </form>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>