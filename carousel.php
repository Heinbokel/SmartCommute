
<div class="godown"></div>

<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
        <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="images/Cara1.jpg" alt="A Petoskey Bike Bath" id="cara1">
            <div class="carousel-content">
                <h1>
                    Commute Smart.
                </h1>
                <p>Bike, run, or carpool to a better environment.</p>
            </div>
        </div>

        <div class="item">
            <a href="about.php"><img src="images/Home%20Page%20Rotator%20Learn%20More2.jpg" alt="A mural on the Petoskey Bike Trail." id="cara2">
                <div class="carousel-content">
                    <h1>
                        Learn More.
                    </h1>
                    <p>The impact of your commute goes beyond yourself.</p>
                </div>
            </a>
        </div>

        <div class="item">
            <img src="images/sponsorrotator.png" alt="The Inn at Bay Harbor seen from the Bike Trail." id="cara3">
            <div class="carousel-content">
                <h1>
                    Our Sponsors.
                </h1>
                <p>Local companies improving our community.</p>
            </div>
        </div>

        <div class="item">
            <a href="rewards.php">
                <img src="images/Home%20Page%20Rotator%20Reward%20Yourself2.jpg" alt="A sunset in Harbor Springs." id="cara4">
                <div class="carousel-content">
                    <h1>Reward Yourself.</h1>
                    <p>Earn great rewards by participating!</p>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="about.php#smartCommuteWeek">
                <img src="images/smartcommuteweekrotator.jpg" alt="A wooded path on the Bike Trail." id="cara5">
                <div class="carousel-content">
                    <h1>Smart Commute Week:</h1>
                    <?php
                    include 'dbconnect.php';
                    $query5 = "SELECT startDate,endDate,DATE_FORMAT(`startDate`,'%M %D') AS date FROM Dates";
                    mysqli_query($db,$query5);
                    $result5 = mysqli_query($db,$query5);
                    while($row = mysqli_fetch_array($result5)) {
                        $displayDate = $row['date'];
                        $date = strtotime($row['startDate']);
                        $remaining = $date - time();
                        $days_remaining = floor($remaining / 86400);
                        $hours_remaining = floor(($remaining % 86400) / 3600);
                        if ($days_remaining >= 0 && $hours_remaining >= 0) {
                            echo "<p>There are only <span class='emphasizeOrange'> $days_remaining days and $hours_remaining hours</span> to go!</p>";
                        } else {
                            echo "<p>Smart Commute Week was <span class='emphasizeOrange'>".$row['date']."</span>.<br>Stay tuned for next year's!</p>";
                        }
                    }?>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="signup.php">
                <img src="images/signupnowrotator.jpg" alt="A wooded path on the Bike Trail." id="cara6">
                <div class="carousel-content">
                    <h1>Sign Up Now.</h1>
                    <p>Ready to join the Smart Commute?</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>