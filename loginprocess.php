<?php
session_start();


include 'dbconnect.php';




$error = false;

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {

    //prevent SQL injections and invalid inputs
    $email = trim($_POST['modalEmail']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $email = mysqli_real_escape_string($db,$email);


    $password = trim($_POST['modalPassword']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);
    $password = mysqli_real_escape_string($db,$password);


    // email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address.";
    }
// password validation
    if (empty($password)) {
        $error = true;
        $passwordError = "Please provide a password.";
    }

    if($error){
        header("Location:loginerror.php");


        $errorMessage = "Incorrect email or password, please try again.";
    } else {
        //hash password
        $password = hash('sha256', $password);

        $res=mysqli_query($db,"SELECT userID, password, fName, lName, adminLevel, level FROM User WHERE email='$email' ");
        $row=mysqli_fetch_array($res);
        $count=mysqli_num_rows($res);
        if (!$res) {
            header("Location:loginerror.php");
        }

        if($count == 1 && $row['password']==$password){
            $_SESSION['user'] = $row['userID'];
            $_SESSION['userName'] = $row['fName'] . " " . $row['lName'];
            $_SESSION['admin'] = $row['adminLevel'];
            $_SESSION['userLevel'] = $row['level'];
            header("Location:account.php");
        } else{
            header("Location:loginerror.php");
        }

    }
}

?>