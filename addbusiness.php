<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    include 'dbconnect.php';


    $placeEmployedName = trim($_POST['placeEmployedName']);
    $placeEmployedName = strip_tags($placeEmployedName);
    $placeEmployedName = htmlspecialchars($placeEmployedName);
    $placeEmployedName = mysqli_real_escape_string($db, $placeEmployedName);

    $query = "INSERT INTO smartcommuteemmet.PlaceEmployed(placeEmployedID,placeEmployedName,placeEmployedAddress)
 VALUES('','$placeEmployedName','')";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("location: managementconsole.php");
    }

    echo("Error:" . mysqli_error($db));

}


?>