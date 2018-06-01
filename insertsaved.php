

<?php
session_start();
$error=false;
echo $_SESSION['message'];
if ($_SERVER['REQUEST_METHOD']=='POST') {


    include 'dbconnect.php';

    $dateCommuteMonth = trim($_POST['dateCommuteMonth']);
    $dateCommuteMonth = strip_tags($dateCommuteMonth);
    $dateCommuteMonth = htmlspecialchars($dateCommuteMonth);
    $dateCommuteMonth = mysqli_real_escape_string($db,$dateCommuteMonth);


    $dateCommuteDay = trim($_POST['dateCommuteDay']);
    $dateCommuteDay = strip_tags($dateCommuteDay);
    $dateCommuteDay = htmlspecialchars($dateCommuteDay);
    $dateCommuteDay = mysqli_real_escape_string($db,$dateCommuteDay);

    $dateCommuteYear = trim($_POST['dateCommuteYear']);
    $dateCommuteYear = strip_tags($dateCommuteYear);
    $dateCommuteYear = htmlspecialchars($dateCommuteYear);
    $dateCommuteYear = mysqli_real_escape_string($db,$dateCommuteYear);

    $tripDate = $dateCommuteYear . '-' . $dateCommuteMonth . '-' . $dateCommuteDay;

    $tripID = $_POST['tripID'];
    $saved = 0;


        $queryTrip = "SELECT tripDate FROM smartcommuteemmet.Trip WHERE Trip.userID = '" . $_SESSION['user'] . "' AND tripDate = '$tripDate'";
        $resultTrip = mysqli_query($db, $queryTrip);
        $countTrip = $resultTrip->num_rows;
        if ($countTrip >= 2) {
            $error = true;
            $_SESSION['message'] = "Enter only 2 trips per date.";

        }

    if ($error) {
        $errorType = "Danger!";
        $errorMessage = "The commute entry attempt failed, please try again in a few minutes.";
        header("location:commuteentry.php");
    } else {
        $query = "INSERT INTO smartcommuteemmet.Trip(startPoint,endPoint,tripMiles,methodOfTravel,tripDate,description,userID,saved)
    SELECT startPoint,endPoint,tripMiles,methodOfTravel,'$tripDate',description,userID,'$saved'
    FROM smartcommuteemmet.Trip
    WHERE tripID='$tripID'";
        $result = mysqli_query($db, $query);
        if ($result) {
            $_SESSION['message']='';
            header("location: account.php#bottom");
        }

        echo("Error:" . mysqli_error($db));

    }
}
?>