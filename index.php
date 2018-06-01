<?php
session_set_cookie_params(0);
session_start();
error_reporting(0);

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
        <title>Smart Commute: Home</title>
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
                <div class="row" id="mainContent2">

                    <div class="col-lg-5">
                        <div class="jumbotron" id="usageStatistics">
                <h2>What have we accomplished?<br></h2>
                <?php include 'usagestatistics.php'?>
            </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="jumbotron" id="signupNow">
                        <?php if(isset($_SESSION['user'])!=""){
                            echo "<h2>Thank you for joining the Smart Commute!</h2>
                    <h3>Improve your health and your community while reducing your footprint on the earth. As an
                 added incentive your participation earns you rewards to local businesses and the opportunity to win prizes! </h3>";
                        }else{
                            echo"
                <h2>Ready to join the Smart Commute?<br></h2>
                <h3>Improve your health and your community while reducing your footprint on the earth. As an
                 added incentive your participation earns you rewards to local businesses and the opportunity to win prizes! </h3>
                <input type='button' value='Log in' id='loginButton' data-toggle='modal' data-target='#myModal'>
                <form action='signup.php' id='indexSignupButton'>
                <input type='submit' value='Sign up' id='signupButton'>
                </form>";}?><hr>
                            <p>Contact Admin@TrailsCouncil.org by June 1st to sign up your organization and indicate your number of members.</p>
                            <br><br><br><br><br><br>
                </div>
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