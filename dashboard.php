<?php 
    session_start();

    $admin_id;

    if(isset($_SESSION["admin-logged"])){
        $admin_id = $_SESSION["admin-logged"];
    }else{
        header('Location:index.php');
    }

?>

<?php
    include "database.php";
?>

<?php

    // Getting user count
    $query = "select count(user_id) from user";
    $user_result = mysqli_query($con,$query);
    $user_array = mysqli_fetch_array($user_result);
    $user_count = $user_array[0];

    // Getting ebook count
    $query = "select count(ebook_id) from ebook inner join admin on admin.admin_id = ebook.admin_id where ebook.admin_id=".$admin_id;
    $ebook_result = mysqli_query($con,$query);
    $ebook_array = mysqli_fetch_array($ebook_result);
    $ebook_count = $ebook_array[0];

    // Getting category count
    $query = "select count(category_id) from category inner join admin on admin.admin_id = category.admin_id where category.admin_id=".$admin_id;
    $category_result = mysqli_query($con,$query);
    $category_array = mysqli_fetch_array($category_result);
    $category_count = $category_array[0];

    // Getting author count
    $query = "select count(author_id) from author inner join admin on admin.admin_id = author.admin_id where author.admin_id=".$admin_id;
    $author_result = mysqli_query($con,$query);
    $author_array = mysqli_fetch_array($author_result);
    $author_count = $author_array[0];

    // Getting publisher count
    $query = "select count(publisher_id) from publisher inner join admin on admin.admin_id = publisher.admin_id where publisher.admin_id=".$admin_id;
    $publisher_result = mysqli_query($con,$query);
    $publisher_array = mysqli_fetch_array($publisher_result);
    $publisher_count = $publisher_array[0];

?>

<?php 

    $year = date("Y");
    $month = date("m");
    $date = date("d");

    // Geting this year sales count
    $query6 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where date like '$year/%' and ebook.admin_id=$admin_id";
    $result6 = mysqli_query($con,$query6);
    $array6 = mysqli_fetch_array($result6);
    $this_year_sales_count = $array6[0];

    // Geting this month sales count
    $query7 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where date like '$year/$month/%' and ebook.admin_id=$admin_id";
    $result7 = mysqli_query($con,$query7);
    $array7 = mysqli_fetch_array($result7);
    $this_month_sales_count = $array7[0];

    // Geting today sales count
    $query8 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where date like '$year/$month/$date' and ebook.admin_id=$admin_id";
    $result8 = mysqli_query($con,$query8);
    $array8 = mysqli_fetch_array($result8);
    $today_sales_count = $array8[0];

    // Total Sales
    $query9 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where ebook.admin_id=$admin_id";
    $result9 = mysqli_query($con,$query9);
    $array9 = mysqli_fetch_array($result9);
    $total_sales_count = $array9[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body background="resources/img/background.jpg" style="background-size: 100%;">
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

        <div class="row" style="padding-top: 10px">
            <div class="col-sm" style="padding-right: 2px;">
                <a href="user.php" style="text-decoration: none">
                    <div class="card text-white bg-info mb-3" style="max-width: 25rem">
                        <div class="card-body">
                            <h1><?php echo $user_count?></h1>
                            <h6>Total Users</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="ebook.php" style="text-decoration: none;">
                    <div class="card text-white bg-danger mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h1><?php echo $ebook_count?></h1>
                            <h6>Total Ebooks</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="category.php" style="text-decoration: none;">
                    <div class="card text-white bg-warning mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h1><?php echo $category_count?></h1>
                            <h6>Total Categories</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="author.php" style="text-decoration: none;">
                    <div class="card text-white bg-primary mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h1><?php echo $author_count?></h1>
                            <h6>Total Authors</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="publisher.php" style="text-decoration: none;">
                    <div class="card text-white bg-success mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h1><?php echo $publisher_count?></h1>
                            <h6>Total Publishers</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm" style="padding-right: 2px;">
                <a href="sales.php?from=from-this-year-sales" style="text-decoration: none;">
                    <div class="card card text-white bg-dark mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h3 id="this_year_sales_count"><?php echo $this_year_sales_count?></h3>
                            <h6>This Year Sales</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="sales.php?from=from-this-month-sales" style="text-decoration: none;">
                    <div class="card text-white bg-dark mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h3 id="this_month_sales_count"><?php echo $this_month_sales_count?></h3>
                            <h6>This Month Sales</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="sales.php?from=from-today-sales" style="text-decoration: none;">
                    <div class="card text-white bg-dark mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h3 id="today_sales_count"><?php echo $today_sales_count?></h3>
                            <h6>Today Sales</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="sales.php?from=from-total-sales" style="text-decoration: none;">
                    <div class="card text-white bg-dark mb-3" style="max-width: 25rem;">
                        <div class="card-body">
                            <h3 id="total_sales_count"><?php echo $total_sales_count?></h3>
                            <h6>Total Sales</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <script type="text/javascript">
                    google.charts.load("current", {packages:['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    
                    function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ["Element", "Sales", { role: "style" } ],
                        ["This Year", Number(document.getElementById("this_month_sales_count").innerHTML), "#b87333"],
                        ["This Month", Number(document.getElementById("this_month_sales_count").innerHTML), "#b87333"],
                        ["Today", Number(document.getElementById("today_sales_count").innerHTML), "#b87333"],
                        ["Total", Number(document.getElementById("total_sales_count").innerHTML), "color: #b87333"]
                    ]);

                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                                    { calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation" },
                                    2]);

                    var options = {
                        title: "Sales Report",
                        bar: {groupWidth: "95%"},
                        legend: { position: "none" },
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                    chart.draw(view, options);
                }
                </script>
                <div id="columnchart_values" style="width: 100%; height: 350px;"></div>
            </div>
            <div class="col-md-6">
                <script>
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = new google.visualization.DataTable();
                        data.addColumn('date', 'Day');
                        data.addColumn('number', 'Sales');

                        datasetObj = [];

                        <?php 

                            $today = date("Y/m/d");

                            for($i = 0; $i<7;$i++){

                                $number = 6 - $i;
                                $day = date("Y/m/d",strtotime(date('Y/m/d').' -'.$number.' days')); 
                                $query10 = "select count(purchasing_records.purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where purchasing_records.date='$day' and ebook.admin_id=$admin_id";
                                $result10 = mysqli_query($con,$query10);

                                echo 'var d = new Date();';
                                echo 'var subs = 6 - '.$i.';';
                                echo 'd.setDate(d.getDate() - subs);';

                                echo 'datasetObj.push([d, '.mysqli_fetch_array($result10)[0].']);';
                            }
                        ?>

                        data.addRows(datasetObj);

                        var options = {
                        title: 'Last 7 day sales',
                        hAxis: {
                            format: 'yy/M/d',
                            gridlines: {count: 15}
                        },
                        vAxis: {
                            gridlines: {color: 'none'},
                            minValue: 0
                        }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));

                        chart.draw(data, options);

                        var button = document.getElementById('change');

                        button.onclick = function () {

                        // If the format option matches, change it to the new option,
                        // if not, reset it to the original format.
                        options.hAxis.format === 'yy/M/d' ?
                        options.hAxis.format = 'MMM dd, yyyy' :
                        options.hAxis.format = 'yy/M/d';

                        chart.draw(data, options);
                        };
                    }
                </script>
                <div id="chart_div2" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
    </div>
    <br />
    <footer style="background-color: blue; height: 100px; width: 100%;">
        <div class="container">
            <br />
            <div class="row">
                <div class="col-sm" style="text-align: center;">
                    <a href="#" style="color: white; text-decoration: none;">About Us</a>
                </div>
                <div class="col-sm" style="text-align: center;">
                    <a href="#" style="color: white; text-decoration: none;">Contacts</a>
                </div>
                <div class="col-sm" style="text-align: center;">
                    <a href="#" style="color: white; text-decoration: none;">Terms of Service</a>
                </div>
                <div class="col-sm" style="text-align: center;">
                    <a href="#" style="color: white; text-decoration: none;">Privacy Policy</a>
                </div>
                <div class="col-sm" style="text-align: center;">
                    <a href="#" style="color: white; text-decoration: none;">Blog</a>
                </div>  
                <div class="col-sm" style="text-align: center;">
                    <a href="#" style="color: white; text-decoration: none;">FAQ</a>
                </div>
            </div>
            <hr />
            <p style="text-align: center; color: white; font-size: 10px;">© 2019 Online Libary System Pvt(Ltd). All Right Reserved</p>
        </div>
    </footer>
</body>
</html>