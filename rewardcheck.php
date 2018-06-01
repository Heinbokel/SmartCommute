<?php
session_start();
include 'dbconnect.php';
//gather user data
$query = "SELECT 
          email,
          level,
          SUM(tripMiles) AS totalMiles,
          COUNT(tripID) AS totalTrips,
          tripDate
          FROM User 
          LEFT JOIN Trip ON Trip.userID = User.userID
          WHERE userID = '{$_SESSION['user']}'AND 
          YEAR(tripDate) = YEAR(getdate())";
mysqli_query($db, $query);

$result = mysqli_query($db, $query);

$row = mysqli_fetch_array($result);

$email=$row['email'];
$level =$row['level'];
$totalMiles =$row['totalMiles'];
$totalTrips = $row['totalTrips'];

//check if the user has passed checkpoints
if($totalMiles >= 10 || $totalTrips >= 2){

    //email them an update on their rewards
    $mailbody = "Congratulations! \n\n You have passed the first milestone in the Smart Commute Rewards Program.\n\n By commuting at least 10 miles or 2 trips, you have earned your first reward!\n\n"
        . "Your newest rewards are:\n1 Grand Prize Drawing Entry.\n\n Keep it up to earn a $10 gift card to Latitude 45 Bicycles and Fitness. \n\n"." 
       \n\n Thank you, \n The Smart Commute Administration";
    $header = "From: Rewards@SmartCommuteEmmet.org\r\n";
    $header .= "Return-Path: Rewards@SmartCommute.org\r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $header.= "MIME-Version: 1.0\r\n";
    $header.= "Content-Type: text/plain; charset=utf-8\r\n";
    $header.= "X-Priority: 1\r\n";

    mail($email,"Smart Commute Emmet Rewards Update", $mailbody,$header);

    //update their level in the database to 1.
    $queryUpdate1 = mysqli_query($db,"UPDATE smartcommuteemmet.User SET 
        level = 1
        WHERE User.userID='{$_SESSION['user']}'");

    $resultUpdate1 = mysqli_query($db, $queryUpdate1);
}else if($totalMiles >= 100 || $totalTrips >= 25){

        //email them an update on their rewards
        $mailbody = "Congratulations! \n\n You have passed the second milestone in the Smart Commute Rewards Program.\n\n By commuting at least 100 miles or 25 trips, you have earned your second reward!\n\n"
            . "Your newest rewards are:\n2 Grand Prize Drawing Entries.\n$10 Latitude 45 Gift Card\n\nRemember you can pick up your rewards at the Top Of Michigan Trails Council Office on M-119. The Grand Prize drawing will take place at the Smart Commute Celebration in October.\n\n"." 
       \n\n Thank you, \n The Smart Commute Administration";
        $header = "From: Rewards@SmartCommuteEmmet.org\r\n";
        $header .= "Return-Path: Rewards@SmartCommute.org\r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $header.= "MIME-Version: 1.0\r\n";
        $header.= "Content-Type: text/plain; charset=utf-8\r\n";
        $header.= "X-Priority: 1\r\n";

        mail($email,"Smart Commute Emmet Rewards Update", $mailbody,$header);

        //update their level in the database to 1.
        $queryUpdate2 = mysqli_query($db,"UPDATE smartcommuteemmet.User SET 
        level = 2
        WHERE User.userID='{$_SESSION['user']}'");

        $resultUpdate2 = mysqli_query($db, $queryUpdate2);
    }else if($totalMiles >= 250 || $totalTrips >= 65){

    //email them an update on their rewards
    $mailbody = "Congratulations! \n\n You have passed the third milestone in the Smart Commute Rewards Program.\n\n By commuting at least 250 miles or 65 trips, you have earned your third reward!\n\n"
        . "Your newest rewards are:\n2 Additional Grand Prize Drawing Entries.\n$10 Grain Train or Crooked Tree Breadworks Gift Card\n\nRemember you can pick up your rewards at the Top Of Michigan Trails Council Office on M-119. The Grand Prize drawing will take place at the Smart Commute Celebration in October.\n\n"." 
       \n\n Thank you, \n The Smart Commute Administration";
    $header = "From: Rewards@SmartCommuteEmmet.org\r\n";
    $header .= "Return-Path: Rewards@SmartCommute.org\r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $header.= "MIME-Version: 1.0\r\n";
    $header.= "Content-Type: text/plain; charset=utf-8\r\n";
    $header.= "X-Priority: 1\r\n";

    mail($email,"Smart Commute Emmet Rewards Update", $mailbody,$header);

    //update their level in the database to 1.
    $queryUpdate3 = mysqli_query($db,"UPDATE smartcommuteemmet.User SET 
        level = 3
        WHERE User.userID='{$_SESSION['user']}'");

    $resultUpdate3 = mysqli_query($db, $queryUpdate3);
}else if($totalMiles >= 500 || $totalTrips >= 125){

    //email them an update on their rewards
    $mailbody = "Congratulations! \n\n You have passed the final milestone in the Smart Commute Rewards Program.\n\n By commuting at least 500 miles or 125 trips, you have earned your final reward!\n\n"
        . "Your newest rewards are:\n4 Additional Grand Prize Drawing Entries.\nComplimentary Yoga Class at Yoga Roots \n\nRemember you can pick up your rewards at the Top Of Michigan Trails Council Office on M-119. The Grand Prize drawing will take place at the Smart Commute Celebration in October.\n\n"." 
       \n\n Thank you, \n The Smart Commute Administration";
    $header = "From: Rewards@SmartCommuteEmmet.org\r\n";
    $header .= "Return-Path: Rewards@SmartCommute.org\r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $header.= "MIME-Version: 1.0\r\n";
    $header.= "Content-Type: text/plain; charset=utf-8\r\n";
    $header.= "X-Priority: 1\r\n";

    mail($email,"Smart Commute Emmet Rewards Update", $mailbody,$header);

    //update their level in the database to 1.
    $queryUpdate3 = mysqli_query($db,"UPDATE smartcommuteemmet.User SET 
        level = 4
        WHERE User.userID='{$_SESSION['user']}'");

    $resultUpdate3 = mysqli_query($db, $queryUpdate3);
}

?>

