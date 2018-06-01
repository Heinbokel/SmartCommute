
<?php
//Step1
include 'dbconnect.php';

error_reporting(0);

ob_start();
session_start();


$getInfo = "SELECT * FROM User WHERE userID = '{$_SESSION['user']}'";
mysqli_query($db, $getInfo);

$results = mysqli_query($db, $getInfo);

$row = mysqli_fetch_array($results);

$dateofbirth = strtotime($row['DOB']);

$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['fName'])) {
        $fName = trim($_POST['fName']);
        $fName = strip_tags($fName);
        $fName = htmlspecialchars($fName);
        $fName = mysqli_real_escape_string($db, $fName);
    }

    if (isset($_POST['fName'])) {
        $lName = trim($_POST['lName']);
        $lName = strip_tags($lName);
        $lName = htmlspecialchars($lName);
        $lName = mysqli_real_escape_string($db, $lName);
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
        $email = mysqli_real_escape_string($db, $email);
    }


    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        $password = strip_tags($password);
        $password = htmlspecialchars($password);
        $password = mysqli_real_escape_string($db, $password);


        $confirmPassword = trim($_POST['confirmPassword']);
        $confirmPassword = strip_tags($confirmPassword);
        $confirmPassword = htmlspecialchars($confirmPassword);
        $confirmPassword = mysqli_real_escape_string($db, $confirmPassword);
    }


    if (isset($_POST['DOBMonth'])) {
        $DOBMonth = trim($_POST['DOBMonth']);
        $DOBMonth = strip_tags($DOBMonth);
        $DOBMonth = htmlspecialchars($DOBMonth);
        $DOBMonth = mysqli_real_escape_string($db, $DOBMonth);


        $DOBDay = trim($_POST['DOBDay']);
        $DOBDay = strip_tags($DOBDay);
        $DOBDay = htmlspecialchars($DOBDay);
        $DOBDay = mysqli_real_escape_string($db, $DOBDay);


        $DOBYear = trim($_POST['DOBYear']);
        $DOBYear = strip_tags($DOBYear);
        $DOBYear = htmlspecialchars($DOBYear);
        $DOBYear = mysqli_real_escape_string($db, $DOBYear);


        $DOB = $DOBYear . '-' . $DOBMonth . '-' . $DOBDay;
    }

    if (isset($_POST['placeEmployment'])) {
        if (isset($_POST['otherEmployer'])) {
            $placeEmployement = trim($_POST['otherEmployer']);
            $placeEmployement = strip_tags($placeEmployement);
            $placeEmployement = htmlspecialchars($placeEmployement);
            $placeEmployement = mysqli_real_escape_string($db, $placeEmployement);

        } else {
            $placeEmployement = trim($_POST['placeEmployment']);
            $placeEmployement = strip_tags($placeEmployement);
            $placeEmployement = htmlspecialchars($placeEmployement);
            $placeEmployement = mysqli_real_escape_string($db, $placeEmployement);
        }
    }

    if (isset($_POST['street'])) {
        $street = trim($_POST['street']);
        $street = strip_tags($street);
        $street = htmlspecialchars($street);
        $street = mysqli_real_escape_string($db, $street);


        $city = trim($_POST['city']);
        $city = strip_tags($city);
        $city = htmlspecialchars($city);
        $city = mysqli_real_escape_string($db, $city);


        $zip = trim($_POST['zip']);
        $zip = strip_tags($zip);
        $zip = htmlspecialchars($zip);
        $zip = mysqli_real_escape_string($db, $zip);
    }



//Validation

// first name validation
    if(isset($_POST['fName'])) {

        if (empty($fName)) {
            $error = true;
            $fNameError = "Please enter your first name.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $fName)) {
            $error = true;
            $fNameError = "Your name must contain only letters.";
        }
    }


// last name validation
    if(isset($_POST['lName'])) {
        if (empty($lName)) {
            $error = true;
            $lNameError = "Please enter your last name.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $lName)) {
            $error = true;
            $lNameError = "Your name must contain only letters.";
        }
    }

// email validation
    if(isset($_POST['email'])) {
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
    }

    // street validation
    if(isset($_POST['street'])) {

        if ((strlen($street) < 2)) {
            $error = true;
            $streetError = "Please enter a proper street address.";
        }

        // city validation
        if ((strlen($city) < 2)) {
            $error = true;
            $cityError = "Please enter a proper city name.";
        }

        // zip validation
        if ((strlen($zip) != 5)) {
            $error = true;
            $zipError = "Please enter a proper 5 digit ZIP Code. $zip";
        }
    }
//employer validation
    if(isset($_POST['otherEmployer'])) {
        if (empty($placeEmployement)) {
            $error = true;
            $otherEmployerError = "Please enter your employer's name.";
        }
    }

// password validation
    if(isset($_POST['password'])) {
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

    }
// If no errors are present, complete signup process.
    if ($error) {
    } else {

        $query = mysqli_query($db,"UPDATE smartcommuteemmet.User SET 
        fName = (case when '$fName' = '' then fName else '$fName' end),
        lName = (case when '$lName' = '' then lName else '$lName' end),
        email = (case when '$email' = '' then email else '$email' end),
        password = (case when '$password' = '' then password else '$password' end),
        DOB = (case when '$DOB' = '' then DOB else '$DOB' end),
        placeEmployed = (case when '$placeEmployement' = '' then placeEmployed else '$placeEmployement' end),
        streetAddress = (case when '$street' = '' then streetAddress else '$street' end),
        city = (case when '$city' = '' then city else '$city' end),
        zip = (case when '$zip' = '' then zip else '$zip' end)
        WHERE User.userID='{$_SESSION['user']}'");
        $_SESSION['userName'] = $row['fName'] . " " . $row['lName'];

        $result = mysqli_query($db, $query);
        header("location: account.php");

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

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="icon" href="images/SMARTCOMMUTELOGO.png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Michigan Trails Council smart commute rewards program.">
        <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
        <meta name="author" content="Robert Heinbokel">
        <title>Smart Commute: Edit Profile</title>
    </head>

    <?php include 'doclinks.php' ?>

    <body>
    <div class="wrapper">
        <header>
            <?php include 'navigation.php'?>

            <!-- Include the Carousel Banner. -->
            <?php include 'carousel.php'?>

        </header>
        <!-- Include the modal for the login button in the nav bar -->
        <?php include 'loginModal.php' ?>

        <div class="content">
                        <div class="jumbotron" id="mainContent1">
                            <h2>Edit your account information:</h2>
                            <h3>Check the box to the right of the fields you wish to edit.</h3>
                        </div>
                        <!--First Name Input-->
                            <form class="form-horizontal" id="editAccountForm" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="fName">First Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="fName"  name="fName" disabled="disabled" style="display:inline;" value="<?php echo $row['fName']; ?>">
                                        <p id="fNameError" class="errorText"><?php echo $fNameError; ?></p>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editFirstName" name="editFirstName" class="form-control" >
                                    </div>
                                </div>

                                <!--Enable Input on checked-->
                                <script>
                                    document.getElementById('editFirstName').onchange = function() {
                                        document.getElementById('fName').disabled = !this.checked;
                                    }
                                </script>

                                <!--Last Name Input-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="lName">Last Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lName"  name="lName" disabled="disabled" style="display:inline;" value="<?php echo $row['lName']; ?>">
                                        <p id="lNameError" class="errorText"><?php echo $lNameError; ?></p>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editLastName" name="editLastName" class="form-control" >
                                    </div>
                                </div>

                                <!--Enable Input on checked-->
                                <script>
                                    document.getElementById('editLastName').onchange = function() {
                                        document.getElementById('lName').disabled = !this.checked;
                                    }
                                </script>

                                <!--Email Input-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="signupEmail">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="signupEmail"  name="email" disabled="disabled" style="display:inline;" value="<?php echo $row['email']; ?>">
                                        <p id="signupEmailError" class="errorText"><?php echo $emailError; ?></p>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editEmail" name="editEmail" class="form-control" >
                                    </div>
                                </div>

                                <!--Enable Input on checked-->
                                <script>
                                    document.getElementById('editEmail').onchange = function() {
                                        document.getElementById('signupEmail').disabled = !this.checked;
                                    }
                                </script>

                                <!--New Password Input-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="signupPassword">New Password:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="signupPassword" placeholder="***********" name="password" disabled="disabled" style="display:inline;" >
                                        <p id="signupPasswordError" class="errorText"><?php echo $passwordError; ?></p>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editPassword" name="editPassword" class="form-control" >
                                    </div>
                                </div>

                                <!--Enable Input on checked-->
                                <script>
                                    document.getElementById('editPassword').onchange = function() {
                                        document.getElementById('signupPassword').disabled = !this.checked;
                                        document.getElementById('signupPasswordConfirm').disabled = !this.checked;
                                    }
                                </script>

                                <!--Confirm New Password-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="signupPasswordConfirm">Confirm New Password:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="signupPasswordConfirm" placeholder="***********" name="confirmPassword" disabled="disabled" style="display:inline;">
                                        <p id="signupPasswordConfirmError" class="errorText"><?php echo $confirmPasswordError; ?></p>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>

                                <!--Date of birth Input-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="signupDOBMonth">Date of Birth:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="editDOBMonth" name="DOBMonth" disabled="disabled">
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
                                        <select class="form-control" id="editDOBDay" name="DOBDay" disabled="disabled">
                                            <?php
                                            $day = date('d');
                                            for ($i = 0; $i<=31;$i++){
                                                $sel = ($i == $day) ? 'selected ="selected"' : '';
                                                echo "<option value=\"$i\"$sel>$i</option>";
                                            }
                                            ?>
                                        </select>
                                        <select class="form-control" id="editDOBYear" name="DOBYear" disabled="disabled">
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
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editDOB" name="editDOB" class="form-control" >
                                    </div>
                                </div>

                                <!--Enable Input on checked-->
                                <script>
                                    document.getElementById('editDOB').onchange = function() {
                                        document.getElementById('editDOBMonth').disabled = !this.checked;
                                        document.getElementById('editDOBDay').disabled = !this.checked;
                                        document.getElementById('editDOBYear').disabled = !this.checked;
                                    }
                                </script>

                                <!--Address Inputs-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="street">Street Address:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="street"   name="street" disabled="disabled" style="display:inline;" value="<?php echo $row['streetAddress']; ?>">
                                        <p id="streetError" class="errorText"><?php echo $streetError; ?></p>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editAddress" name="editAddress" class="form-control" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="city">City:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="city"   name="city" disabled="disabled" style="display:inline;" value="<?php echo $row['city']; ?>">
                                        <p id="cityError" class="errorText"><?php echo $cityError; ?></p>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editAddress2" name="editAddress2" class="form-control" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="zip">ZIP:</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="zip"  name="zip" disabled="disabled" style="display:inline;" value="<?php echo $row['zip']; ?>">
                                        <p id="zipError" class="errorText"><?php echo $zipError; ?></p>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editAddress3" name="editAddress3" class="form-control" >
                                    </div>
                                </div>

                                <!--Enable Input on Checked-->
                                <script>
                                    document.getElementById('editAddress').onchange = function() {
                                        document.getElementById('street').disabled = !this.checked;
                                    }
                                </script>
                                <script>
                                    document.getElementById('editAddress2').onchange = function() {
                                        document.getElementById('city').disabled = !this.checked;
                                    }
                                </script>
                                <script>
                                    document.getElementById('editAddress3').onchange = function() {
                                        document.getElementById('zip').disabled = !this.checked;
                                    }
                                </script>

                                <!--Employer Input-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="placeEmployment">Place of Employment:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="editPlaceEmployment" name="placeEmployment" disabled="disabled" style="display:inline;">
                                            <?php
                                            include 'populateemployers.php';
                                            ?>
                                            <option value="other">OTHER</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" value="" id="editEmployer" name="editEmployer" class="form-control" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="otherEmployer">Other:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="otherEmployer"   name="otherEmployer" style="display:inline;" value="<?php echo $row['placeEmployed']; ?>">
                                        <p id="otherEmployerError" class="errorText"><?php echo $otherEmployerError; ?></p>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>

                                <!--Enable Input on Checked-->
                                <script>
                                    document.getElementById('editEmployer').onchange = function() {
                                        document.getElementById('editPlaceEmployment').disabled = !this.checked;
                                    }
                                </script>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-default" name="submit" value="Submit Changes" id="formSignup"></input>
                                    </div>
                                </div>
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
        <?php include 'footer.php' ?>
    </div>
    </body>
    </html>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>