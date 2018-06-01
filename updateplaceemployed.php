<?php
//Step1
include 'dbconnect.php';

error_reporting(0);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $placeEmployed = trim($_POST['placeEmployed']);
    $placeEmployed = strip_tags($placeEmployed);
    $placeEmployed = htmlspecialchars($placeEmployed);
    $placeEmployed = mysqli_real_escape_string($db, $placeEmployed);

    $rowID = trim($_POST['userID']);
    $rowID = strip_tags($rowID);
    $rowID = htmlspecialchars($rowID);
    $rowID = mysqli_real_escape_string($db,$rowID);


    $query = mysqli_query($db,"UPDATE smartcommuteemmet.User 
                        SET placeEmployed = '$placeEmployed' WHERE userID = $rowID");

    $result = mysqli_query($db, $query);

    header("location: managementconsole.php");
    if($result){
            }else{
        echo "mysql_error($db)
<br>There was an error updating the placeEmployed column. Please try again later or contact your database administrator.";



    }
}
mysqli_close($db);




?>