<?php error_reporting(0);
session_start();
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
        <title>Smart Commute: Total Trips</title>

        <?php include 'doclinks.php' ?>

    </head>
    <body>
    <header>
        <?php include 'navigation.php'?>

        <!-- Include carousel banner-->
        <?php include 'carousel.php'?>

    </header>
    <!-- Modal -->
    <?php include 'loginModal.php' ?>

    <div class="content">
        <div class="jumbotron" id="totalTrips">
            <?php include 'populatebusinessleaderboards.php';?>
        </div>





    </div>
    <?php include 'footer.php'?>
    </body>
    </html>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>