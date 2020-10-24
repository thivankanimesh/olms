<?php 
    session_start();

    $seller_id;

    if(isset($_SESSION["seller-logged"])){
        $seller_id = $_SESSION["seller-logged"];
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
    $query = "select count(ebook_id) from ebook inner join seller on seller.seller_id = ebook.seller_id where ebook.seller_id=".$seller_id;
    $ebook_result = mysqli_query($con,$query);
    $ebook_array = mysqli_fetch_array($ebook_result);
    $ebook_count = $ebook_array[0];

    // Getting category count
    $query = "select count(category_id) from category inner join seller on seller.seller_id = category.seller_id where category.seller_id=".$seller_id;
    $category_result = mysqli_query($con,$query);
    $category_array = mysqli_fetch_array($category_result);
    $category_count = $category_array[0];

    // Getting author count
    $query = "select count(author_id) from author inner join seller on seller.seller_id = author.seller_id where author.seller_id=".$seller_id;
    $author_result = mysqli_query($con,$query);
    $author_array = mysqli_fetch_array($author_result);
    $author_count = $author_array[0];

    // Getting publisher count
    $query = "select count(publisher_id) from publisher inner join seller on seller.seller_id = publisher.seller_id where publisher.seller_id=".$seller_id;
    $publisher_result = mysqli_query($con,$query);
    $publisher_array = mysqli_fetch_array($publisher_result);
    $publisher_count = $publisher_array[0];

?>

<?php 

    $year = date("Y");
    $month = date("m");
    $date = date("d");

    // Geting this year sales count
    $query6 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where date like '$year/%' and ebook.seller_id=$seller_id";
    $result6 = mysqli_query($con,$query6);
    $array6 = mysqli_fetch_array($result6);
    $this_year_sales_count = $array6[0];

    // Geting this month sales count
    $query7 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where date like '$year/$month/%' and ebook.seller_id=$seller_id";
    $result7 = mysqli_query($con,$query7);
    $array7 = mysqli_fetch_array($result7);
    $this_month_sales_count = $array7[0];

    // Geting today sales count
    $query8 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where date like '$year/$month/$date' and ebook.seller_id=$seller_id";
    $result8 = mysqli_query($con,$query8);
    $array8 = mysqli_fetch_array($result8);
    $today_sales_count = $array8[0];

    // Total Sales
    $query9 = "select count(purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where ebook.seller_id=$seller_id";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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

        <div class="row" style="padding-top: 10px">
            <div class="col-sm" style="padding-right: 2px;">
                <a href="user.php" style="text-decoration: none">
                    <div class="card text-white mb-3" style="max-width: 25rem; background-color:#760000;">
                        <div class="card-body">
                            <h1><?php echo $user_count?></h1>
                            <h6>Total Users</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="ebook.php" style="text-decoration: none;">
                    <div class="card text-white mb-3" style="max-width: 25rem; background-color:#ffd033;">
                        <div class="card-body">
                            <h1><?php echo $ebook_count?></h1>
                            <h6>Total eBooks</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="category.php" style="text-decoration: none;">
                    <div class="card text-white mb-3" style="max-width: 25rem; background-color:#00003f;">
                        <div class="card-body">
                            <h1><?php echo $category_count?></h1>
                            <h6>Total Categories</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="author.php" style="text-decoration: none;">
                    <div class="card text-white mb-3" style="max-width: 25rem; background-color:#252525;">
                        <div class="card-body">
                            <h1><?php echo $author_count?></h1>
                            <h6>Total Authors</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <a href="publisher.php" style="text-decoration: none;">
                    <div class="card text-white mb-3" style="max-width: 25rem; background-color:#93004a;">
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
                <form action="sales.php" method="POST">
                    <div class="card card text-white mb-3" style="max-width: 25rem; background-color:#001900;">
                        <button name="from-form-dashboard" type="submit" class="btn" style="max-width: 25rem; color:#ffffff;">
                            <h3 id="this_year_sales_count"><?php echo $this_year_sales_count?></h3>
                            <h6>Yearly Sales</h6>
                        </button>
                    </div>
                    <input type="hidden" name="from" value="form-this-year-sales" />
                </form>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <form action="sales.php" method="POST">
                    <div class="card card text-white mb-3" style="max-width: 25rem; background-color:#001900;">
                        <button name="from-form-dashboard" type="submit" class="btn" style="max-width: 25rem; color:#ffffff;">
                            <h3 id="this_month_sales_count"><?php echo $this_month_sales_count?></h3>
                            <h6>Monthly Sales</h6>
                        </button>
                    </div>
                    <input type="hidden" name="from" value="form-this-month-sales" />
                </form>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <form action="sales.php" method="POST">
                    <div class="card card text-white mb-3" style="max-width: 25rem; background-color:#001900;">
                        <button name="from-form-dashboard" type="submit" class="btn" style="max-width: 25rem; color:#ffffff;">
                            <h3 id="today_sales_count"><?php echo $today_sales_count?></h3>
                            <h6>Today Sales</h6>
                        </button>
                    </div>
                    <input type="hidden" name="from" value="form-today-sales" />
                </form>
            </div>
            <div class="col-sm" style="padding-right: 2px;">
                <form action="sales.php" method="POST">
                    <div class="card card text-white mb-3" style="max-width: 25rem; background-color:#001900;">
                        <button name="from-form-dashboard" type="submit" class="btn" style="max-width: 25rem; color:#ffffff;">
                            <h3 id="total_sales_count"><?php echo $total_sales_count?></h3>
                            <h6>Total Sales</h6>
                        </button>
                    </div>
                    <input type="hidden" name="from" value="form-total-sales" />
                </form>
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
                                $query10 = "select count(purchasing_records.purchasing_record_id) from purchasing_records inner join ebook on ebook.ebook_id = purchasing_records.ebook_id where purchasing_records.date='$day' and ebook.seller_id=$seller_id";
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
</body>
</html>