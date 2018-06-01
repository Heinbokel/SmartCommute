<?php
//Step1
include 'dbconnect.php';

error_reporting(0);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $startDateMonth = $_POST['startDateMonth'];
    $startDateDay = $_POST['startDateDay'];
    $startDateYear = $_POST['startDateYear'];

    $startDate = $startDateYear."-".$startDateMonth."-".$startDateDay;


    $query = mysqli_query($db,"UPDATE smartcommuteemmet.Dates 
                        SET startDate = '$startDate'
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