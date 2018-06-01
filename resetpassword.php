<?php
//Step1
include 'dbconnect.php';

ob_start();
session_start();
//set errors to false as default, so they don't automatically pop up.
$error = false;

//if the form is submitted:
if ($_SERVER['REQUEST_METHOD']=='POST') {

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $email = mysqli_real_escape_string($db,$email);


    $password = trim($_POST['newPassword']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);
    $password = mysqli_real_escape_string($db,$password);


    $confirmPassword = trim($_POST['confirmPassword']);
    $confirmPassword = strip_tags($confirmPassword);
    $confirmPassword = htmlspecialchars($confirmPassword);
    $confirmPassword = mysqli_real_escape_string($db,$confirmPassword);


    //validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address.";
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

    $hash=$_POST['q'];

    $salt ="123321";

    $resetkey = hash('sha256', $salt . $email);

    if($resetkey == $hash){
        if($password == $confirmPassword){
            //hash new password
            $password = hash('sha256',$password);

            $query = "UPDATE smartcommuteemmet.User SET password = '$password' WHERE email = '$email'";
            $result = mysqli_query($db, $query);
            if($result) {
                $generalError = "Your password has sucessfully been changed.";
            } /*else{
                echo("Error description: " . mysqli_error($db));
            }*/
        }else {
            $generalError = "Your passwords do not match.";
        }
    }else {
        $generalError = "Your password reset key is not valid.";
    }
}
?>



<?php error_reporting(0); ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="icon" href="images/SMARTCOMMUTELOGO.png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="Michigan Trails Council smart commute rewards program.">
        <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
        <meta name="author" content="Robert Heinbokel">
        <title>Smart Commute: Reset Password</title>
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
                <h2>Password Reset Form</h2>
                <p>Use the form below to reset your password:</p>
                <form class="form-horizontal" id="changePasswordForm" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="emailPasswordChange">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="emailPasswordChange" placeholder="JSmith@gmail.com" required="required"  name="email">
                            <p id="emailError" class="errorText"><?php echo $emailError; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="newPassword">New Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="newPassword" placeholder="JSmith@gmail.com" required="required"  name="newPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="newPassword">Confirm Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirmNewPassword" placeholder="JSmith@gmail.com" required="required"  name="confirmPassword">
                        </div>
                    </div>
                    <input type="hidden" name="q" value="<?php echo $_GET['q']; ?>"
                    <div class="form-group">
                        <div class ="col-sm-12">
                        <input type="submit" class="btn btn-default" name="submit" value="Reset" id="resetPasswordSubmit"></input>
                        </div>
                        <p id="generalError" class="errorText"><?php echo $generalError; ?></p>

                    </div>
                </form>
            </div>
        </div>
        <?php include 'footer.php' ?>
    </div>
    </body>
    </html>

