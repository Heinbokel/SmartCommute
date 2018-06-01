<?php
//Step1
include 'dbconnect.php';

ob_start();
session_start();
//set errors to false as default, so they don't automatically pop up.
$error = false;

//if the form is submitted:
if ($_SERVER['REQUEST_METHOD']=='POST') {

    //set email variable, prevent injection.
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $email = mysqli_real_escape_string($db,$email);


    // email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address.";
    }

    $res=mysqli_query($db,"SELECT * FROM User WHERE email='$email' ");
    $count = mysqli_num_rows($res);
    if($count == 1){
        $salt ="123321";
        $password = hash('sha256',$salt.$email);
        $reseturl = "http://www.SmartCommuteEmmet.org/resetpassword.php?q=".$password;
        $mailbody = "Greetings, \n\n A password reset request has been initiated for the Trails Council Smart Commute account associated with this email address.\n
       If you did not initiate this request, then please ignore this email. If you did initiate this request, please click the link below: \n\n" . $reseturl . " 
       \n\n Thank you, \n The Smart Commute Administration";
        $header = "From:Support@SmartCommuteEmmet.org\r\n";
        $header .= "Return-Path: Support@SmartCommute.org\r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $header.= "MIME-Version: 1.0\r\n";
        $header.= "Content-Type: text/plain; charset=utf-8\r\n";
        $header.= "X-Priority: 1\r\n";

        mail($email,"Smart Commute Emmet Password Reset", $mailbody,$header);
        $emailError = "Your password recovery key has been sent to the email address provided.";
        $spamCheck = " Please check your spam or junk folder.";
    }else{
        $emailError ="This email address does not exist in our system.";
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
        <title>Smart Commute: Forgot Password</title>
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
                <h2>Reset your password:</h2>
                <p>If you have forgotten your password, we will email you a reset request.<br> Please enter
                the email associated with your Smart Commute account:</p>
                <form class="form-horizontal" id="resetPasswordForm" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="emailPasswordReset">Email:</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="emailPasswordReset" placeholder="JSmith@gmail.com" required="required"  name="email">
                        </div>
                        <div class ="col-sm-4">
                            <input type="submit" class="btn btn-default" name="submit" value="Reset" id="resetPasswordSubmit"></input>
                        </div>
                    </div>
                    <p id="emailError" class="errorText"><?php echo $emailError ."<br>" . $spamCheck; ?></p>
                </form>
            </div>
        </div>
        <?php include 'footer.php' ?>
    </div>
    </body>
    </html>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>