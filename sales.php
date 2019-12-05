<?php

    session_start();

    $admin_id;

    if(isset($_SESSION["admin-logged"])){
        $admin_id = $_SESSION["admin-logged"];
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

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    if(isset($_GET['from'])){
        $from = $_GET['from'];
    }
    
    if($from == "form-this-year-sales"){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year%' and admin_id = $admin_id");
        
    }else if($from == "from-this-month-sales"){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month%' and admin_id = $admin_id");
        
    }else if($from == "from-today-sales"){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month/$date' and admin_id = $admin_id");
        
    }else if($from == "from-total-sales"){

        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where admin_id = $admin_id");
        
    }else{
        $result2 = mysqli_query($con,"select count(DISTINCT(ebook.ebook_id)) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '2019%' and admin_id = $admin_id");  
    }

    $rows_array2 = mysqli_fetch_array($result2);

    $sales_count = $rows_array2[0];

    $items_per_page = 1;
    $required_pages = ceil($sales_count/$items_per_page); 

    $start = $items_per_page*$page -$items_per_page;
    $end = $items_per_page;


    // This is for retriveing data
    $row_list1 = array();

    if($from == "form-this-year-sales"){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year%' and admin_id = $admin_id limit $start, $end");

    }else if($from == "from-this-month-sales"){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month%' and admin_id = $admin_id limit $start, $end");

    }else if($from == "from-today-sales"){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '$year/$month/$date%' and admin_id = $admin_id limit $start, $end");

    }else if($from == "from-total-sales"){

        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where admin_id = $admin_id limit $start, $end");

    }else {
        $result3 = mysqli_query($con,"select DISTINCT ebook.ebook_id as ebook_ebook_id, ebook.title as ebook_title from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.date like '2019%' and admin_id = $admin_id limit $start, $end");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
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
                    <h2 class="text-center">Sales</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <table class="table table-borderless table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                $index=$start+1;
                                foreach($row_list1 as $row){

                                    if($from == "form-this-year-sales"){

                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and purchasing_records.date like '$year%' and ebook.admin_id=".$admin_id."");

                                    }else if($from == "from-this-month-sales"){

                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and purchasing_records.date like '$year/$month%' and ebook.admin_id=".$admin_id."");

                                    }else if($from == "from-today-sales"){

                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and purchasing_records.date like '$year/$month/$date%' and ebook.admin_id=".$admin_id."");

                                    }else if($from == "from-total-sales"){

                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and ebook.admin_id=".$admin_id."");

                                    }else {
                                        $result4 = mysqli_query($con,"select count(purchasing_records.ebook_id) from ebook inner join purchasing_records on purchasing_records.ebook_id = ebook.ebook_id where purchasing_records.ebook_id=".$row['ebook_ebook_id']." and purchasing_records.date like '2019%' and ebook.admin_id=".$admin_id."");
                                    }

                                    echo '<tr>
                                        <td>'.$index.'</td>
                                        <td>'.$row['ebook_title'].'</td>
                                        <td>'.mysqli_fetch_array($result4)[0].'</td>
                                    </tr>';
                                    $index++;
                                }
                            ?>
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
                                echo '<li class="page-item"><a class="page-link" href="sales.php?page='.$i.'&from='.$from.'">'.$i.'</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>