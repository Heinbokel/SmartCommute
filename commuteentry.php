<?php error_reporting(0);
session_start();
if(!isset($_SESSION['user'])){
    header("location: signup.php");
}
?>


<?php
//Step1
include 'dbconnect.php';


ob_start();
session_start();

$error = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//prevent injection
    $travelMethod = trim($_POST['travelMethod']);
    $travelMethod = strip_tags($travelMethod);
    $travelMethod = htmlspecialchars($travelMethod);
    $travelMethod = mysqli_real_escape_string($db,$travelMethod);


    $milesTraveled = trim($_POST['milesTraveled']);
    $milesTraveled = strip_tags($milesTraveled);
    $milesTraveled = htmlspecialchars($milesTraveled);
    $milesTraveled = mysqli_real_escape_string($db,$milesTraveled);


    if(isset($_POST['otherStart'])) {
        $startPoint = trim($_POST['otherStart']);
        $startPoint = strip_tags($startPoint);
        $startPoint = htmlspecialchars($startPoint);
        $startPoint = mysqli_real_escape_string($db,$startPoint);

    }else{
        $startPoint = trim($_POST['startPoint']);
        $startPoint = strip_tags($startPoint);
        $startPoint = htmlspecialchars($startPoint);
        $startPoint = mysqli_real_escape_string($db,$startPoint);

    }

    if(isset($_POST['otherEnd'])) {
        $endPoint = trim($_POST['otherEnd']);
        $endPoint = strip_tags($endPoint);
        $endPoint = htmlspecialchars($endPoint);
        $endPoint = mysqli_real_escape_string($db,$endPoint);
    }else{
        $endPoint = trim($_POST['endPoint']);
        $endPoint = strip_tags($endPoint);
        $endPoint = htmlspecialchars($endPoint);
        $endPoint = mysqli_real_escape_string($db,$endPoint);

    }

    if(isset($_POST['rememberCommute'])){
        $saved = 1;
    }else {$saved = 0;}

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


    $dateCommute = $dateCommuteYear . '-' . $dateCommuteMonth . '-' . $dateCommuteDay;

    $commuteDescription = trim($_POST['commuteDescription']);
    $commuteDescription = strip_tags($commuteDescription);
    $commuteDescription = htmlspecialchars($commuteDescription);
    $commuteDescription = mysqli_real_escape_string($db,$commuteDescription);


    if(isset($_POST['commuteName'])) {
        $commuteName = trim($_POST['commuteName']);
        $commuteName = strip_tags($commuteName);
        $commuteName = htmlspecialchars($commuteName);
        $commuteName = mysqli_real_escape_string($db,$commuteName);

    }else {$commuteName = "";}

    //validation

    //no more than 2 commutes per day
    if(isset($_POST['dateCommuteMonth'])){
        $queryTrip = "SELECT tripDate FROM smartcommuteemmet.Trip WHERE Trip.userID = '".$_SESSION['user']."' AND tripDate = '$dateCommute'";
        $resultTrip = mysqli_query($db, $queryTrip);
        $countTrip = $resultTrip->num_rows;
        if ($countTrip >= 2) {
            $error = true;
            $dateCommuteError = "You may only enter two trips per day.";

        }
    }


    //milesTraveled

    if($milesTraveled <1 || $milesTraveled > 20){
        $error = true;
        $milesTraveledError = "Please enter an amount between 1 and 20.";
    }else if(!is_numeric($milesTraveled)){
        $error=true;
        $milesTraveledError="Please enter only numbers or decimals between 1 and 20.";
    }

    //commuteName
    if(isset($_POST['commuteName'])) {
        if (EMPTY($commuteName)) {
            $error = true;
            $commuteNameError = "Please enter a name for this Commute.";
        }/* else if (!preg_match("/^[a-zA-Z0-9]+$/", $commuteName)) {
            $error = true;
            $commuteNameError = "Your commute name must contain only letters and or numbers.";
        }*/
    }

   /* if (!EMPTY($commuteDescription)) {
        if (!preg_match("/^[a-zA-Z0-9]+$/", $commuteDescription)) {
            $error = true;
            $commuteDescriptionError = "Your commute description must contain only letters and or numbers.";
        }
    }*/

    if(isset($_POST['otherStart'])) {
        if (empty($startPoint) || (strlen($startPoint) < 2)) {
            $error = true;
            $otherStartError = "Please enter a proper start point.";
        }/*else if (!preg_match("/^[a-zA-Z0-9]+$/", $startPoint)) {
            $error = true;
            $otherStartError = "Your start point must contain only letters and or numbers.";
        }*/
    }

    if(isset($_POST['otherEnd'])) {
        if (empty($endPoint) || (strlen($endPoint) < 2)) {
            $error = true;
            $otherEndError = "Please enter a proper end point.";
        }/*else if (!preg_match("/^[a-zA-Z0-9]+$/", $endPoint)) {
            $error = true;
            $otherEndError = "Your end point must contain only letters and or numbers.";
        }*/
    }

// If no errors are present, complete commute entry process.
    if ($error) {
        $errorType = "Danger!";
        $errorMessage = "The commute entry attempt failed, please try again in a few minutes.";
        } else {
        $query = "INSERT INTO smartcommuteemmet.Trip(tripID,startPoint,endPoint,tripMiles,methodOfTravel,tripDate,description,userID,tripName,saved)
				VALUES('','$startPoint','$endPoint','$milesTraveled','$travelMethod','$dateCommute','$commuteDescription',{$_SESSION['user']},'$commuteName','$saved')";
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
            $_SESSION['message']='';
            /*include 'rewardcheck.php';*/
            header("Location: account.php#bottom");

        }
    }
}

ob_end_flush();
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/SMARTCOMMUTELOGO.png">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Michigan Trails Council smart commute rewards program.">
    <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
    <meta name="author" content="Robert Heinbokel">
    <title>Smart Commute: Commute Entry</title>

<?php include 'doclinks.php' ?>

</head>
<body>
<header>
    <?php include 'navigation.php'?>

    <?php include 'carousel.php'?>
</header>
<!-- Modal -->
<?php include 'loginModal.php' ?>

<div class="content">
    <div class="jumbotron" id="mainContent1">
        <?php
        include 'dbconnect.php';
        $query5 = "SELECT * FROM Dates";
        mysqli_query($db,$query5);
        $result5 = mysqli_query($db,$query5);
        while($row = mysqli_fetch_array($result5)) {
            if (strtotime(date('Y-m-d')) < strtotime($row['endDate']) && strtotime(date('Y-m-d')) > strtotime($row['startDate']) ) {
                include 'commuteentryform.php';
            } else {
                echo "<p>Thank you for your interest in the Emmet County Smart Commute Program. Smart Commute has concluded for this
            year and will resume in the Spring. Follow us on <a href=\"https://www.facebook.com/SmartCommuteEmmet/\">Facebook</a> for updates about the program.</p>";
            }
        }?>


         </div>
<?php include 'footer.php'?>
</body>
</html>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>