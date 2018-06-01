<?php error_reporting(0);
session_start();

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
            include 'rewardcheck.php';
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
            <h2>Enter your trip details:</h2>
            <div id="savedTrips" class="collapse">
                <?php include 'populatesaved.php'?>
            </div>
            <input type="button" data-toggle="collapse" data-target="#savedTrips" value="Saved Trips" id="signupButton">


            <input type="button" data-toggle="collapse" data-target="#rules" value="Rules" id="signupButton">
            <div id="rules" class="collapse">
                <ul class="list">
                    <li>You may earn up to two trips per day.</li>
                    <li>Maximum of 20 miles per trip.</li>
                    <li>Count any trip that you would make in a car. Ex: your trip to work, the grocery store, or school.</li>
                    <li>For carpooling there must be a minimum of 3 passengers.</li>

                </ul>
            </div>

        </div>

        <form class="form-horizontal" id="commuteEntryForm" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
            <div class="form-group">
                <h1 id="outputTest"></h1>
                <label class="control-label col-sm-2" for="dateCommute">Date of Commute:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="dateCommute" name="dateCommuteMonth">
                        <?php
                        $arr_m = array("January","February","March","April","May","June","July","August","September","October","November","December");
                        $month = date('m');
                        for ($i = 6; $i<=$month;$i++){
                            $name = $arr_m[$i-1];
                            $sel = ($i == $month) ? 'selected ="selected"' : '';
                            echo "<option value=\"$i\"$sel>$name</option>";
                        }
                        ?>
                    </select>
                    <select class="form-control" id="dateCommuteDay" name="dateCommuteDay">
                        <?php
                        $day = date('d');
                        for ($i = 5; $i<=$day;$i++){
                            $sel = ($i == $day) ? 'selected ="selected"' : '';
                            echo "<option value=\"$i\"$sel>$i</option>";
                        }

                        ?>
                    </select>
                    <select class="form-control" id="dateCommuteYear" name="dateCommuteYear">
                        <?php

                        $year = date('Y');
                        echo"<option value='$year'>$year</option>";?>
                    </select>
                    <p id="dateCommuteError" class="errorText"><?php echo $dateCommuteError . $_SESSION['message']; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="travelMethod">Method of Travel:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="travelMethod" required="required" name="travelMethod">
                        <option>Bicycle</option>
                        <option>Running/Walking</option>
                        <option>Carpool</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="milesTraveled">Miles Traveled:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="milesTraveled" placeholder="How long was your commute?" required="required" name="milesTraveled">
                    <p id="milesTraveledError" class="errorText"><?php echo $milesTraveledError; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="startPoint">Start Point:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="startPoint" required="required" name="startPoint">
                        <option>Petoskey Downtown</option>
                        <option>Petoskey West of Bear River</option>
                        <option>Petoskey Other</option>
                        <option>Harbor Springs City</option>
                        <option>Bear Creek Township</option>
                        <option>Resort Township</option>
                        <option>SpringVale Township</option>
                        <option>Littlefield Township</option>
                        <option>Little Traverse Township</option>
                        <option>West Traverse Township</option>
                        <option>Pleasantview Township</option>
                        <option>Friendship Township</option>
                        <option>Maple River Township</option>
                        <option value="other">OTHER</option>
                    </select>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#otherStart').attr('disabled','disabled');
                    $('select[name="startPoint"]').on('change',function(){
                        var  other = $(this).val();
                        if(other == "other"){
                            $('#otherStart').removeAttr('disabled');
                        }else{
                            $('#otherStart').attr('disabled','disabled');
                        }

                    });
                });
            </script>
            <div class="form-group">
                <label class="control-label col-sm-2" for="otherStart">Other:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="otherStart" placeholder="Enter your start point here..."  name="otherStart">
                    <p id="otherStartError" class="errorText"><?php echo $otherStartError; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="endPoint">End point:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="endPoint" required="required" name="endPoint">
                        <option>Petoskey Downtown</option>
                        <option>Petoskey West of Bear River</option>
                        <option>Petoskey Other</option>
                        <option>Harbor Springs City</option>
                        <option>Bear Creek Township</option>
                        <option>Resort Township</option>
                        <option>SpringVale Township</option>
                        <option>Littlefield Township</option>
                        <option>Little Traverse Township</option>
                        <option>West Traverse Township</option>
                        <option>Pleasantview Township</option>
                        <option>Friendship Township</option>
                        <option>Maple River Township</option>
                        <option value="other">OTHER</option>
                    </select>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#otherEnd').attr('disabled','disabled');
                    $('select[name="endPoint"]').on('change',function(){
                        var  other = $(this).val();
                        if(other == "other"){
                            $('#otherEnd').removeAttr('disabled');
                        }else{
                            $('#otherEnd').attr('disabled','disabled');
                        }

                    });
                });
            </script>
            <div class="form-group">
                <label class="control-label col-sm-2" for="otherEnd">Other:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="otherEnd" placeholder="Enter your end point here..."  name="otherEnd">
                    <p id="otherEndError" class="errorText"><?php echo $otherEndError; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="commuteDescription">Commute Description:</label>
                <div class="col-sm-10">
                    <textarea id="commuteDescription" placeholder="Enter any notes about your commute here." name="commuteDescription"></textarea>
                    <p><span class="errorText"><?php echo $commuteDescriptionError; ?></span></p>

                </div>
            </div>
            <div class="form-group">
                <div class="control-label col-sm-2">
                    <label>Save Options?</label>
                </div>
                <div class="col-sm-1">
                    <input type="checkbox" value="" id="rememberCommute" name="rememberCommute" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="commuteName">Commute Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="commuteName" placeholder="Enter a unique name to save this commute to your saved commutes." disabled=""  name="commuteName" >
                    <span class="errorText"><?php echo $commuteNameError; ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="commuteSubmit" id="commuteSubmit" value="Submit">Submit</button>
                </div>
            </div>
        </form>
        <script>
            document.getElementById('rememberCommute').onchange = function() {
                document.getElementById('commuteName').disabled = !this.checked;
            }
        </script>
    </div>
    <?php include 'footer.php'?>
    </body>
    </html>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>