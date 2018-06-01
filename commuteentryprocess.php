<?php
//Step1
include 'dbconnect.php';


ob_start();
session_start();

$error = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

//prevent injection
    $travelMethod = trim($_GET['travelMethod']);
    $travelMethod = strip_tags($travelMethod);
    $travelMethod = htmlspecialchars($travelMethod);

    $milesTraveled = trim($_GET['milesTraveled']);
    $milesTraveled = strip_tags($milesTraveled);
    $milesTraveled = htmlspecialchars($milesTraveled);

    $startPoint = trim($_GET['startPoint']);
    $startPoint = strip_tags($startPoint);
    $startPoint = htmlspecialchars($startPoint);


    $endPoint = trim($_GET['endPoint']);
    $endPoint = strip_tags($endPoint);
    $endPoint = htmlspecialchars($endPoint);


    $dateCommuteMonth = trim($_GET['dateCommuteMonth']);
    $dateCommuteMonth = strip_tags($dateCommuteMonth);
    $dateCommuteMonth = htmlspecialchars($dateCommuteMonth);

    $dateCommuteDay = trim($_GET['dateCommuteDay']);
    $dateCommuteDay = strip_tags($dateCommuteDay);
    $dateCommuteDay = htmlspecialchars($dateCommuteDay);

    $dateCommuteYear = trim($_GET['dateCommuteYear']);
    $dateCommuteYear = strip_tags($dateCommuteYear);
    $dateCommuteYear = htmlspecialchars($dateCommuteYear);

    $dateCommute = $_GET['dateCommuteYear'] . '-' . $_GET['dateCommuteMonth'] . '-' . $_GET['dateCommuteDay'];

    $commuteDescription = trim($_GET['commuteDescription']);
    $commuteDescription = strip_tags($commuteDescription);
    $commuteDescription = htmlspecialchars($commuteDescription);

    //validation

    //milesTraveled

    if($milesTraveled <1 || $milesTraveled > 50){
        $error = true;
        $milesTraveledError = "Please enter an amount between 1 and 50.";
    }


// If no errors are present, complete commute entry process.
    if ($error) {
        $errorType = "Danger!";
        $errorMessage = "The commute entry attempt failed, please try again in a few minutes.";
        echo $errorMessage;
    } else {
        $query = "INSERT INTO smartcommuteemmet.Trip(tripID,startPoint,endPoint,tripMiles,methodOfTravel,tripDate,description,userID)
				VALUES('','$startPoint','$endPoint','$milesTraveled','$travelMethod','$dateCommute','$commuteDescription',{$_SESSION['user']})";
        $result = mysqli_query($db, $query);
        if ($result) {
            $errorType = "Success";
            $errorMessage = "You have successfully entered your commute.";
            echo $errorMessage;
            unset($startPoint);
            unset($endPoint);
            unset($milesTraveled);
            unset($travelMethod);
            unset($commuteDescription);
            unset($dateCommuteDay);
            unset($dateCommuteMonth);
            unset($dateCommuteYear);
            header("Location: account.php");

        }
    }
}

ob_end_flush();
?>