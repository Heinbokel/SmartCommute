<?php
//Step1
include 'dbconnect.php';

error_reporting(0);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $captain = trim($_POST['captain']);
    $captain = strip_tags($captain);
    $captain = htmlspecialchars($captain);
    $captain = mysqli_real_escape_string($db, $captain);

    $rowID = trim($_POST['placeEmployedID']);
    $rowID = strip_tags($rowID);
    $rowID = htmlspecialchars($rowID);
    $rowID = mysqli_real_escape_string($db,$rowID);


    $query = mysqli_query($db,"UPDATE smartcommuteemmet.PlaceEmployed 
                        SET captain = '$captain' WHERE placeEmployedID = $rowID");

    $result = mysqli_query($db, $query);

    header("location: managementconsole.php");
    if($result){
            }else{
        echo "mysql_error($db)
<br>There was an error updating the Captain column. Please try again later or contact your database administrator.";



    }
}
mysqli_close($db);




?>