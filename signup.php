
<?php
//Step1
include 'dbconnect.php';

error_reporting(0);

ob_start();
session_start();
if(isset($_SESSION['user'])!=""){
    header("location: account.php");
}


$error = false;

if ($_SERVER['REQUEST_METHOD']=='POST') {


    $fName = trim($_POST['fName']);
    $fName = strip_tags($fName);
    $fName = htmlspecialchars($fName);
    $fName = mysqli_real_escape_string($db,$fName);


    $lName = trim($_POST['lName']);
    $lName = strip_tags($lName);
    $lName = htmlspecialchars($lName);
    $lName = mysqli_real_escape_string($db,$lName);


    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $email = mysqli_real_escape_string($db,$email);



    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);
    $password = mysqli_real_escape_string($db,$password);


    $confirmPassword = trim($_POST['confirmPassword']);
    $confirmPassword = strip_tags($confirmPassword);
    $confirmPassword = htmlspecialchars($confirmPassword);
    $confirmPassword = mysqli_real_escape_string($db,$confirmPassword);



    $DOBMonth = trim($_POST['DOBMonth']);
    $DOBMonth = strip_tags($DOBMonth);
    $DOBMonth = htmlspecialchars($DOBMonth);
    $DOBMonth = mysqli_real_escape_string($db,$DOBMonth);


    $DOBDay = trim($_POST['DOBDay']);
    $DOBDay = strip_tags($DOBDay);
    $DOBDay = htmlspecialchars($DOBDay);
    $DOBDay = mysqli_real_escape_string($db,$DOBDay);


    $DOBYear = trim($_POST['DOBYear']);
    $DOBYear = strip_tags($DOBYear);
    $DOBYear = htmlspecialchars($DOBYear);
    $DOBYear = mysqli_real_escape_string($db,$DOBYear);


    $DOB = $DOBYear . '-' . $DOBMonth . '-' . $DOBDay;

    if(isset($_POST['otherEmployer'])) {
        $placeEmployement = trim($_POST['otherEmployer']);
        $placeEmployement = strip_tags($placeEmployement);
        $placeEmployement = htmlspecialchars($placeEmployement);
        $placeEmployement = mysqli_real_escape_string($db,$placeEmployement);

    }else {
        $placeEmployement = trim($_POST['placeEmployment']);
        $placeEmployement = strip_tags($placeEmployement);
        $placeEmployement = htmlspecialchars($placeEmployement);
        $placeEmployement = mysqli_real_escape_string($db,$placeEmployement);

    }

    $street = trim($_POST['street']);
    $street = strip_tags($street);
    $street = htmlspecialchars($street);
    $street = mysqli_real_escape_string($db,$street);


    $city = trim($_POST['city']);
    $city = strip_tags($city);
    $city = htmlspecialchars($city);
    $city = mysqli_real_escape_string($db,$city);


    $zip = trim($_POST['zip']);
    $zip = strip_tags($zip);
    $zip = htmlspecialchars($zip);
    $zip = mysqli_real_escape_string($db,$zip);


//Validation

// first name validation
    if (empty($fName)) {
        $error = true;
        $fNameError = "Please enter your first name.";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $fName)) {
        $error = true;
        $fNameError = "Your name must contain only letters.";
    }

// last name validation
    if (empty($lName)) {
        $error = true;
        $lNameError = "Please enter your last name.";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $lName)) {
        $error = true;
        $lNameError = "Your name must contain only letters.";
    }


// email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address.";
    } else {
        // check email exist or not
        $query = "SELECT email FROM User WHERE email='$email'";
        $result = mysqli_query($db, $query);
        $count = $result->num_rows;
        if ($count != 0) {
            $error = true;
            $emailError = "This email is already associated with an account.";
        }
    }

    // street validation
    if(!empty($street) && (strlen($street) < 2)){
        $error = true;
        $streetError = "Please enter a proper street address.";
    }

    // city validation
    if(!empty($city) && (strlen($city) < 2)){
        $error = true;
        $cityError = "Please enter a proper city name.";
    }

    // zip validation
    if(!empty($zip) && (strlen($zip)!=5)){
        $error = true;
        $zipError = "Please enter a proper 5 digit ZIP Code. $zip";
    }

if(isset($_POST['otherEmployer'])) {
    if (empty($placeEmployement)) {
        $error = true;
        $otherEmployerError = "Please enter your employer's name.";
    }
}

// password validation
    if (empty($password)) {
        $error = true;
        $passwordError = "Please provide a password.";
    } else if (strlen($password) < 8) {
        $error = true;
        $passwordError = "Your password must be at least 8 characters.";
    }


// confirm password validation
    if (empty($confirmPassword)) {
        $error = true;
        $confirmPasswordError = "Please confirm your password.";
    } else if ($password !== $confirmPassword) {
        $error = true;
        $confirmPasswordError = "Your passwords did not match.";
    }


//encrypt password
    $password = hash('sha256', $password);


// If no errors are present, complete signup process.
    if ($error) {
    } else {

        $query = mysqli_query($db, "INSERT INTO smartcommuteemmet.User(userID,fName,lName,email,password,DOB,placeEmployed,totalMiles,totalTrips,streetAddress,city,zip)
				VALUES('','$fName','$lName','$email','$password','$DOB','$placeEmployement',0,0,'$street','$city','$zip')");
        $result = mysqli_query($db, $query);
        header("location: signupcomplete.php");

        if($result) {
            $errorType = "Success";
            $errorMessage = "You have successfully registered, please log in.";
            unset($fName);
            unset($lName);
            unset($email);
            unset($password);
            unset($confirmPassword);
            unset($DOBDay);
            unset($DOBMonth);
            unset($DOBYear);
            unset($street);
            unset($city);
            unset($zip);
        }
    }
}

ob_end_flush();
?>



<?php
session_start();
if(isset($_SESSION['user'])!=""){
    header("location: account.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/SMARTCOMMUTELOGO.png">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Michigan Trails Council smart commute rewards program.">
    <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
    <meta name="author" content="Robert Heinbokel">
    <title>Smart Commute: Sign up</title>
<!-- Make an i agree to be emailed button -->
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
        <h2>Already have an account?</h2>
        <input type="button" value="Log in" id="loginButton" data-toggle="modal" data-target="#myModal">
    </div>

    <form class="form-horizontal" id="signupForm" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
        <h2>Create Your Account:</h2>
        <div class="form-group">
            <label class="control-label col-sm-2" for="fName">First Name:<span class="emphasizeOrange"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fName" placeholder="First" required="required"  name="fName">
                <p id="fNameError" class="errorText"><?php echo $fNameError; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="lName">Last Name:<span class="emphasizeOrange"> *</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lName" placeholder="Last" required="required" name="lName">
                <p id="lNameError" class="errorText"><?php echo $lNameError; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="signupEmail">Email:<span class="emphasizeOrange"> *</span></label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="signupEmail" placeholder="Enter email" required="required" name="email" >
                <p id="signupEmailError" class="errorText"><?php echo $emailError; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="signupPassword">Password:<span class="emphasizeOrange"> *</span></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="signupPassword" placeholder="***********" required="required" name="password"">
                <p id="signupPasswordError" class="errorText"><?php echo $passwordError; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="signupPasswordConfirm">Confirm Password:<span class="emphasizeOrange"> *</span></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="signupPasswordConfirm" placeholder="***********" required="required" name="confirmPassword">
                <p id="signupPasswordConfirmError" class="errorText"><?php echo $confirmPasswordError; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="signupDOBMonth">Date of Birth:<span class="emphasizeOrange"> *</span></label>
            <div class="col-sm-10">
                <select class="form-control" id="signupDOBMonth" name="DOBMonth">
                    <?php
                    $arr_m = array("January","February","March","April","May","June","July","August","September","October","November","December");
                    $month = date('m');
                    for ($i = 0; $i<=12;$i++){
                        $name = $arr_m[$i-1];
                        $sel = ($i == $month) ? 'selected ="selected"' : '';
                        echo "<option value=\"$i\"$sel>$name</option>";
                    }
                    ?>
                </select>
                <select class="form-control" id="signupDOBDay" name="DOBDay">
                    <?php
                    $day = date('d');
                    for ($i = 0; $i<=31;$i++){
                        $sel = ($i == $day) ? 'selected ="selected"' : '';
                        echo "<option value=\"$i\"$sel>$i</option>";
                    }
                    ?>
                </select>
                <select class="form-control" id="signupDOBYear" name="DOBYear">
                    <?php
                    $year = date('Y') - 14;
                    $years = $year-100;
                    for ($i = $year; $i>=$years;$i--){
                        $sel = ($i == $year) ? 'selected ="selected"' : '';
                        echo "<option value=\"$i\"$sel>$i</option>";
                    }
                    ?>
                </select>
                <p id="signupDOBError" class="errorText"></p>
            </div>
        </div>
        <a data-toggle="collapse" data-target="#why"><span class="emphasizeOrange" id="whyLink">Why is this important?</span></a>
        <div id="why" class="collapse">
            One goal of this program is to identify our commuter patterns. This is valuable information for planning
            future infrastructure projects such as bike lanes.
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="street">Street Address:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="street" placeholder="123 Abc Avenue"  name="street">
                <p id="streetError" class="errorText"><?php echo $streetError; ?></p>
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="city">City:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="city" placeholder="Petoskey"  name="city">
                <p id="cityError" class="errorText"><?php echo $cityError; ?></p>
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="zip">ZIP:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="zip" placeholder="49770"  name="zip">
                <p id="zipError" class="errorText"><?php echo $zipError; ?></p>
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="placeEmployment">Place of Employment:</label>
            <div class="col-sm-10">
                <select class="form-control" id="placeEmployment" name="placeEmployment">
                    <?php
                    include 'populateemployers.php';
                    ?>
                    <option value="other">OTHER</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="otherEmployer">Other:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="otherEmployer" placeholder="Enter your employer here..."  name="otherEmployer">
                <p id="otherEmployerError" class="errorText"><?php echo $otherEmployerError; ?></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" name="submit" value="Sign Up!" id="formSignup"></input>
            </div>
        </div>
        <p id="requiredText">* = required.</p><br>
    </form>
    <script>
        $(document).ready(function() {
            $('#otherEmployer').attr('disabled','disabled');
            $('select[name="placeEmployment"]').on('change',function(){
                var  other = $(this).val();
                if(other == "other"){
                    $('#otherEmployer').removeAttr('disabled');
                }else{
                    $('#otherEmployer').attr('disabled','disabled');
                }

            });
        });
    </script>
</div>
<?php include 'footer.php'?>
</body>
</html>

