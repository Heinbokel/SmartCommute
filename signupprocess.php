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

if ($_SERVER['REQUEST_METHOD']=='GET') {



    $fName = trim($_GET['fName']);
    $fName = strip_tags($fName);
    $fName = htmlspecialchars($fName);

    $lName = trim($_GET['lName']);
    $lName = strip_tags($lName);
    $lName = htmlspecialchars($lName);

    $email = trim($_GET['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);


    $password = trim($_GET['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    $confirmPassword = trim($_GET['confirmPassword']);
    $confirmPassword = strip_tags($confirmPassword);
    $confirmPassword = htmlspecialchars($confirmPassword);


    $DOBMonth = trim($_GET['DOBMonth']);
    $DOBMonth = strip_tags($DOBMonth);
    $DOBMonth = htmlspecialchars($DOBMonth);

    $DOBDay = trim($_GET['DOBDay']);
    $DOBDay = strip_tags($DOBDay);
    $DOBDay = htmlspecialchars($DOBDay);

    $DOBYear = trim($_GET['DOBYear']);
    $DOBYear = strip_tags($DOBYear);
    $DOBYear = htmlspecialchars($DOBYear);

    $DOB = $_GET['DOBYear'] . '-' . $_GET['DOBMonth'] . '-' . $_GET['DOBDay'];

    $placeEmployement = trim($_GET['placeEmployment']);
    $placeEmployement = strip_tags($placeEmployement);
    $placeEmployement = htmlspecialchars($placeEmployement);

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
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($db, $query);
        $count = $result->num_rows;
        if ($count != 0) {
            $error = true;
            $emailError = "This email is already associated with an account.";
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
        echo "ERROR";
        header("Location: index.php");

    } else {

         $query = mysqli_query($db, "INSERT INTO smartcommuteemmet.User(userID,fName,lName,email,password,DOB,placeEmployed,totalMiles,totalTrips)
				VALUES('','$fName','$lName','$email','$password','$DOB','$placeEmployement',0,0)");
        $result = mysqli_query($db, $query);

        if($result) {
            header("Location: signupcomplete.php");
            echo "GOOD TO GO";
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

        }
    }
}

ob_end_flush();
?>
