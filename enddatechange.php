<?php
//Step1
include 'dbconnect.php';

error_reporting(0);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $endDateMonth = $_POST['endDateMonth'];
    $endDateDay = $_POST['endDateDay'];
    $endDateYear = $_POST['endDateYear'];

    $endDate = $endDateYear."-".$endDateMonth."-".$endDateDay;


    $query = mysqli_query($db,"UPDATE smartcommuteemmet.Dates 
                        SET endDate = '$endDate'
                        WHERE id = 1");

    $result = mysqli_query($db, $query);
    header("location: managementconsole.php");
    if($result){
    }else {
        echo "mysql_error($db)
<br>There was an error updating the startDate column. Please try again later or contact your database administrator.";
    }



}
mysqli_close($db);




?>