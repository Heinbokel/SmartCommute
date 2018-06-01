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
    <title>Michigan Trails Smart Commute: Rewards</title>
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
        <div class ="jumbotron" id="mainContent1">
            <h1 class="pageTitle">The Smart Commute Rewards Program</h1>
        </div>
    <div class="jumbotron" id="about2">
        <div class="row">
            <div class="col-lg-7">
        <h2>Why?</h2>
        <p>Our thought was that If commuting smart for a week is good, then a month would
            be great, and a whole season even better. The best way to get there was to
            incentivize participation and that brings us to the rewards program. </p>
                <h2>How to Participate?</h2>
                <p>Commute smart, log your mileage and trips, and earn rewards. It’s as simple as that!
                    Continue reading for basic rules about which trips count and how much you can earn in a day.</p>
                <h2>Which Trips Count?</h2>
                <p>The goal of this program is to replace automobile travel with more sustainable and healthier alternatives.
                   Any local trip that would or could be made by car can be counted. Examples include trips to work, school,
                   the store, or running errands. Both the trip to your destination and the trip home count. Each day a
                   participant can record a maximum of 2 trips or 40 miles.</p>
            </div>
            <div class="col-lg-5">
                <h2>Methods of Travel</h2>
                <p>The most common ways to participate are walking, running, and cycling. Other forms of human powered
                    travel are also encouraged. If your commute is to far to reasonable complete on foot or by bike
                    check out one of our <a href="about.php#smartCommuteWeek" style="color:orange;">Smart Commute Lots</a> to help shorten
                    the distance. Carpooling counts as well and requires at least three occupants in the vehicle.</p>
            </div>
        </div>
    </div>
        <div class="jumbotron" id="about5">
            <div class="row">
                <div class="col-lg-7">
            <h2>When do I Earn Rewards?</h2>
            <p>Rewards are based on mileage or number of commutes (Trips). You will be able to reach reward levels by
                completing the required number of either. By doing this the program does not favor those with longer
                commutes who can easily generate miles, or those with very short commutes who can easily participate every day.<br><br>

                After achieving each level you will receive a gift certificate or discount to a participating business
                and entries into the Grand Prize Drawing. You will receive a confirmation email from rewards@smartcommuteemmet.org
                and can pick up your rewards at the Top Of Michigan Trails Council Office on M-119. The grand prize drawing will
                take place at the Smart Commute Celebration in October.</p>
                </div>
                <div class="col-lg-5">
                    <h2>Rewards</h2>
            <div class='table-responsive' id="rewardTable">
                <table class="table">
                <tr>
                <th>Distance</th>
                <th>Rewards</th>
                </tr>
                <tr>
                    <td>10 Miles or 2 Trips</td>
                    <td>Grand Prize Drawing Entry</td>
                </tr>
                <tr>
                    <td>100 Miles or 25 Trips</td>
                    <td>Reward + 1 Additional Drawing Entry</td>
                </tr>
                <tr>
                    <td>250 Miles or 65 Trips</td>
                    <td>Reward + 2 Additional Drawing Entries</td>
                </tr>
                <tr>
                    <td>500 Miles or 125 Trips</td>
                    <td>Reward + 4 Additional Drawing Entries</td>
                </tr>
            </table>
                <h3>Grand Prizes:</h3>
                <ul>
                    <li>Latitude 45 $500 Gift Card </li>
                    <li>Bearcub Outfitters $250 Gift Card</li>
                    <li>McLean and Eakin $100 Gift Card</li>
                </ul>
            </div>
        </div>
            </div>
        </div>
        <div class="jumbotron" id="signupNow">
            <?php if(isset($_SESSION['user'])!=""){
                echo "<h2>Thank you for joining the Smart Commute!</h2>";
            }else{
                echo"
                <h2>Ready to join the Smart Commute?<br></h2>
                <h3>Log in or join the program now:</h3>
                <input type='button' value='Log in' id='loginButton' data-toggle='modal' data-target='#myModal'>
                <form action='signup.php' id='indexSignupButton'>
                <input type='submit' value='Sign up' id='signupButton'>
                </form>";}?>
        </div>
    </div>
    <?php include 'footer.php' ?>
</div>
</body>
</html>