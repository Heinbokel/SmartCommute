<?php
session_start();
error_reporting(0);
include 'dbconnect.php';
$yearSearchError = "";
if (empty($_POST['yearSearch']) || $_POST['yearSearch'] < 2017) {
        $_SESSION['leaderYear'] = date('Y');
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $leaderYear = trim($_POST['yearSearch']);
    $leaderYear = strip_tags($leaderYear);
    $leaderYear = htmlspecialchars($leaderYear);
    $leaderYear = mysqli_real_escape_string($db, $leaderYear);

    if (is_nan($leaderYear) || $leaderYear < 2017) {
        $yearSearchError = "Please enter a valid year from 2017 or later.";
        $_SESSION['leaderYear'] = date('Y');
    } else {
        $_SESSION['leaderYear'] = $leaderYear;
    }
}
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
    <title>Smart Commute: My Account</title>
</head>

<?php include 'doclinks.php' ?>
<?php include 'confirmdeletetripmodal.php'?>
<body>
<div class="wrapper">
<header>
    <?php include 'navigation.php'?>

    <?php include 'carousel.php'?>


</header>
    <!-- Include the modal for the login button in the nav bar -->
<?php include 'loginModal.php' ?>
    <?php include 'logoutModal.php'?>

<div class="content">

    <div class="jumbotron" id="accountInfo">
        <h2>My Account</h2>
        <h3>Welcome, <span class="emphasizeCyan"> <?php echo $_SESSION['userName']; ?></span></h3>
        <h3><a class="emphasizeOrange" target="_blank" href="./documents/breakfastvoucher2018.pdf">Download Breakfast Vouchers Here</a></h3>
        <?php
        session_start();
        if($_SESSION['admin'] >= 1){
            echo "<h2><a href='http://www.smartcommuteemmet.org/managementconsole.php' class='emphasizeOrange'>Click Here for the Management Console</a></h2><br>";
        }
        ?>
        <div id="accountButtons">
            <div id="userInfo" class="collapse">
                <?php include'populateuserinfo.php' ?>
            </div>
            <div id="userRewards" class="collapse">
                <?php
                session_start();
                include 'dbconnect.php';
                //gather user data
                $rewardQuery = "SELECT 
          SUM(tripMiles) AS totalMiles,
          COUNT(tripID) AS totalTrips,
          tripDate,
          Trip.userID
          FROM Trip
          WHERE userID = '{$_SESSION['user']}' AND 
          YEAR(tripDate) = {$_SESSION['leaderYear']}
          ";
                mysqli_query($db, $rewardQuery);

                $rewardResult = mysqli_query($db, $rewardQuery);

                $rewardRow = mysqli_fetch_array($rewardResult);

                $email=$rewardRow['email'];
                $level =$rewardRow['level'];
                $totalMiles =$rewardRow['totalMiles'];
                $totalTrips = $rewardRow['totalTrips'];
                echo "<p>For year: {$_SESSION['leaderYear']}</p>";
                echo "Total Miles: {$rewardRow['totalMiles']}<br>";
                echo "Total Trips: {$rewardRow['totalTrips']}";
                if($totalMiles < 10 && $totalTrips < 2){
                    echo "<p>You currently do not have any rewards. Commute at least 10 miles or 2 trips to earn your first!</p>";
                }else if($totalMiles >= 10 && $totalMiles < 100 && $totalTrips >= 2 && $totalTrips < 25){
                    echo "<p>Your current rewards are: <br><span class='emphasizeOrange'> 1 Grand Prize Drawing Entry</span> <br><br> Commute at least 100 miles or 25 trips to earn your next reward!</p>";
                }else if($totalMiles >= 100 && $totalMiles < 250 && $totalTrips >= 25 && $totalTrips < 65){
                    echo "<p>Your current rewards are: <br><span class='emphasizeOrange'> 3 Grand Prize Drawing Entries <br> $10 Latitude 45 Gift Card </span><br><br> Commute at least 250 miles or 65 trips to earn your next reward!</p>";
                }else if($totalMiles >= 250 && $totalMiles < 500 && $totalTrips >= 65 && $totalTrips < 125){
                    echo "<p>Your current rewards are: <br><span class='emphasizeOrange'> 5 Grand Prize Drawing Entries <br> $10 Latitude 45 Gift Card <br> $10 Grain Train or Crooked Tree Breadworks Gift Card </span>
                          <br><br> Commute at least 500 miles or 125 trips to earn your next reward!</p>";
                }else if($totalMiles >= 500 && $totalTrips >= 125){
                    echo "<p>Your current rewards are: <br><span class='emphasizeOrange'> 9 Grand Prize Drawing Entries <br> $10 Latitude 45 Gift Card <br> $10 Grain Train or Crooked Tree Breadworks Gift Card 
                         <br> Complimentary Yoga Class at Yoga Roots </span><br><br> You have achieved the highest possible rewards!</p>";
                }
                echo "<h5>Remember you can pick up your rewards at the Top Of Michigan Trails Council Office on M-119. The Grand Prize drawing will take place at the Smart Commute Celebration in October.</h5><br>";
                ?>
            </div>
                <input type="button" data-toggle="collapse" data-target="#userInfo" value="User Info" id="signupButton">

            <input type="button" data-toggle="collapse" data-target="#userRewards" value="Rewards" id="signupButton">
        <form action='commuteentry.php' id='indexSignupButton'>
            <input type='submit' value='Enter Trip' id='signupButton'>
        </form>
            <input type='button' value='Log Out' id='signupButton' id='accountLogout' data-toggle='modal' data-target='#logoutModal'>

            <input type="button" data-toggle="collapse" data-target="#savedTrips" value="Saved Trips" id="signupButton">
            <div id="savedTrips" class="collapse">
                <?php
                $query5 = "SELECT * FROM Dates";
                mysqli_query($db,$query5);
                $result5 = mysqli_query($db,$query5);

                $query6 = "SELECT DAY(startDate) as day FROM Dates";
                mysqli_query($db,$query6);
                $result6 = mysqli_query($db,$query6);
                $rows = mysqli_fetch_assoc($result6);

                while($row = mysqli_fetch_array($result5)) {
                    if (strtotime(date('Y-m-d')) < strtotime($row['endDate']) && strtotime(date('Y-m-d')) > strtotime($row['startDate'])) {
                        include 'populatesaved.php';
                    }else{
                        echo "<p>This feature will return when commute entry is enabled this Spring!</p>";
                    }
                }
                ?>
                <script>
                    $('select[name="dateCommuteMonth"]').on('change',function(){
                        console.log("Changed Month Saved Commutes");
                        var select2 = document.getElementById("dateCommuteMonthSaved");
                        var month2 = select2.options[select2.selectedIndex].text;
                        var daySelects = document.getElementsByClassName('dateCommuteDay');
                        var monthSelects = document.getElementsByClassName('dateCommuteMonth');
                        var startDate = "<?php echo $rows['day']; ?>";
                        console.log("SELECT2 EQUALS: "+select2);
                        console.log("MONTH2 EQUALS: "+month2);
                        if(month2 == "June") {
                            console.log("MONTH IS JUNE");
                            var month = new Date();
                            month = month.getMonth();
                            console.log(month);
                            if(month == 5) {
                                var date = new Date().getDate();
                                console.log(date);
                                var dateString = '';
                                for (i = startDate; i <= date; i++) {
                                    dateString += '<option value=' + i + '>' + i + '</option>';
                                }
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = dateString;
                                });
                            }else {
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML =
                                        '<option value=4>4</option>' +
                                        '<option value=5>5</option>' +
                                        '<option value=6>6</option>' +
                                        '<option value=7>7</option>' +
                                        '<option value=8>8</option>' +
                                        '<option value=9>9</option>' +
                                        '<option value=10>10</option>' +
                                        '<option value=11>11</option>' +
                                        '<option value=12>12</option>' +
                                        '<option value=13>13</option>' +
                                        '<option value=14>14</option>' +
                                        '<option value=15>15</option>' +
                                        '<option value=16>16</option>' +
                                        '<option value=17>17</option>' +
                                        '<option value=18>18</option>' +
                                        '<option value=19>19</option>' +
                                        '<option value=20>20</option>' +
                                        '<option value=21>21</option>' +
                                        '<option value=22>22</option>' +
                                        '<option value=23>23</option>' +
                                        '<option value=24>24</option>' +
                                        '<option value=25>25</option>' +
                                        '<option value=26>26</option>' +
                                        '<option value=27>27</option>' +
                                        '<option value=28>28</option>' +
                                        '<option value=29>29</option>' +
                                        '<option value=30>30</option>'
                                    ;
                                });
                            }
                        }else if(month2 == "July"){
                            console.log("MONTH IS JULY");
                            var month = new Date();
                            month = month.getMonth();
                            console.log(month);
                            if(month == 6) {
                                var date = new Date().getDate();
                                console.log(date);
                                var dateString = '';
                                for (i = 1; i <= date; i++) {
                                    dateString += '<option value=' + i + '>' + i + '</option>';
                                }
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = dateString;
                                });
                            }else {
                                [].slice.call( daySelects ).forEach(function ( daySelects ) {
                                    daySelects.innerHTML = '<option value=1>1</option>' +
                                        '<option value=2>2</option>' +
                                        '<option value=3>3</option>' +
                                        '<option value=4>4</option>' +
                                        '<option value=5>5</option>'+
                                        '<option value=6>6</option>'+
                                        '<option value=7>7</option>' +
                                        '<option value=8>8</option>' +
                                        '<option value=9>9</option>' +
                                        '<option value=10>10</option>'+
                                        '<option value=11>11</option>'+
                                        '<option value=12>12</option>'+
                                        '<option value=13>13</option>'+
                                        '<option value=14>14</option>' +
                                        '<option value=15>15</option>'+
                                        '<option value=16>16</option>' +
                                        '<option value=17>17</option>'+
                                        '<option value=18>18</option>' +
                                        '<option value=19>19</option>'+
                                        '<option value=20>20</option>'+
                                        '<option value=21>21</option>'+
                                        '<option value=22>22</option>'+
                                        '<option value=23>23</option>'+
                                        '<option value=24>24</option>'+
                                        '<option value=25>25</option>'+
                                        '<option value=26>26</option>'+
                                        '<option value=27>27</option>'+
                                        '<option value=28>28</option>'+
                                        '<option value=29>29</option>'+
                                        '<option value=30>30</option>'+
                                        '<option value=31>31</option>'
                                    ;
                                });
                            }
                        }else if(month2 == "August") {
                            console.log("MONTH IS AUGUST");
                            var month = new Date();
                            month = month.getMonth();
                            console.log(month);
                            if (month == 7) {
                                var date = new Date().getDate();
                                console.log(date);
                                var dateString = '';
                                for (i = 1; i <= date; i++) {
                                    dateString += '<option value=' + i + '>' + i + '</option>';
                                }
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = dateString;
                                });
                            } else {
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = '<option value=1>1</option>' +
                                        '<option value=2>2</option>' +
                                        '<option value=3>3</option>' +
                                        '<option value=4>4</option>' +
                                        '<option value=5>5</option>' +
                                        '<option value=6>6</option>' +
                                        '<option value=7>7</option>' +
                                        '<option value=8>8</option>' +
                                        '<option value=9>9</option>' +
                                        '<option value=10>10</option>' +
                                        '<option value=11>11</option>' +
                                        '<option value=12>12</option>' +
                                        '<option value=13>13</option>' +
                                        '<option value=14>14</option>' +
                                        '<option value=15>15</option>' +
                                        '<option value=16>16</option>' +
                                        '<option value=17>17</option>' +
                                        '<option value=18>18</option>' +
                                        '<option value=19>19</option>' +
                                        '<option value=20>20</option>' +
                                        '<option value=21>21</option>' +
                                        '<option value=22>22</option>' +
                                        '<option value=23>23</option>' +
                                        '<option value=24>24</option>' +
                                        '<option value=25>25</option>' +
                                        '<option value=26>26</option>' +
                                        '<option value=27>27</option>' +
                                        '<option value=28>28</option>' +
                                        '<option value=29>29</option>' +
                                        '<option value=30>30</option>' +
                                        '<option value=31>31</option>'
                                    ;
                                });
                            }
                        }else if(month2 == "September") {
                            console.log("MONTH IS SEPTEMBER");
                            var month = new Date();
                            month = month.getMonth();
                            console.log(month);
                            if (month == 8) {
                                var date = new Date().getDate();
                                console.log(date);
                                var dateString = '';
                                for (i = 1; i <= date; i++) {
                                    dateString += '<option value=' + i + '>' + i + '</option>';
                                }
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = dateString;
                                });
                            } else {
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = '<option value=1>1</option>' +
                                        '<option value=2>2</option>' +
                                        '<option value=3>3</option>' +
                                        '<option value=4>4</option>' +
                                        '<option value=5>5</option>' +
                                        '<option value=6>6</option>' +
                                        '<option value=7>7</option>' +
                                        '<option value=8>8</option>' +
                                        '<option value=9>9</option>' +
                                        '<option value=10>10</option>' +
                                        '<option value=11>11</option>' +
                                        '<option value=12>12</option>' +
                                        '<option value=13>13</option>' +
                                        '<option value=14>14</option>' +
                                        '<option value=15>15</option>' +
                                        '<option value=16>16</option>' +
                                        '<option value=17>17</option>' +
                                        '<option value=18>18</option>' +
                                        '<option value=19>19</option>' +
                                        '<option value=20>20</option>' +
                                        '<option value=21>21</option>' +
                                        '<option value=22>22</option>' +
                                        '<option value=23>23</option>' +
                                        '<option value=24>24</option>' +
                                        '<option value=25>25</option>' +
                                        '<option value=26>26</option>' +
                                        '<option value=27>27</option>' +
                                        '<option value=28>28</option>' +
                                        '<option value=29>29</option>' +
                                        '<option value=30>30</option>'
                                    ;
                                });
                            }
                        }else if(month2 == "October") {
                            console.log("MONTH IS OCTOBER");
                            var month = new Date();
                            month = month.getMonth();
                            console.log(month);
                            if (month == 9) {
                                var date = new Date().getDate();
                                console.log(date);
                                var dateString = '';
                                for (i = 1; i <= date; i++) {
                                    dateString += '<option value=' + i + '>' + i + '</option>';
                                }
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = dateString;
                                });
                            } else {
                                [].slice.call(daySelects).forEach(function (daySelects) {
                                    daySelects.innerHTML = '<option value=1>1</option>' +
                                        '<option value=2>2</option>' +
                                        '<option value=3>3</option>' +
                                        '<option value=4>4</option>' +
                                        '<option value=5>5</option>' +
                                        '<option value=6>6</option>' +
                                        '<option value=7>7</option>' +
                                        '<option value=8>8</option>' +
                                        '<option value=9>9</option>' +
                                        '<option value=10>10</option>' +
                                        '<option value=11>11</option>' +
                                        '<option value=12>12</option>' +
                                        '<option value=13>13</option>' +
                                        '<option value=14>14</option>' +
                                        '<option value=15>15</option>' +
                                        '<option value=16>16</option>' +
                                        '<option value=17>17</option>' +
                                        '<option value=18>18</option>' +
                                        '<option value=19>19</option>' +
                                        '<option value=20>20</option>' +
                                        '<option value=21>21</option>' +
                                        '<option value=22>22</option>' +
                                        '<option value=23>23</option>' +
                                        '<option value=24>24</option>' +
                                        '<option value=25>25</option>' +
                                        '<option value=26>26</option>' +
                                        '<option value=27>27</option>' +
                                        '<option value=28>28</option>' +
                                        '<option value=29>29</option>' +
                                        '<option value=30>30</option>'+
                                        '<option value=31>31</option>'
                                    ;
                                });
                            }
                        }
                    });
                </script>
            </div>
        </div>

    </div>

    <h2>My Trips: <?php echo "{$_SESSION['leaderYear']}";?></h2>
    <div style="width:100%; margin:0 auto; text-align:center;">
    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST' style="display:inline;">
        <label for="yearSearch">Year:</label>
        <select name="yearSearch" id="yearSearch" class="dateChange">
            <?php
            $year = date('Y');
            $years = 2017;
            for ($i = $year; $i>=$years;$i--){
                $sel = ($i == $year) ? 'selected ="selected"' : '';
                echo "<option value=\"$i\"$sel>$i</option>";
            }
            ?>
        </select>
        <?php echo "<p class='errorText'>$yearSearchError</p>" ?>
        <input type='submit' name='Submit'>
    </form>
    </div>
    <br>
    <div class='table-responsive' id="accountTripsDiv">
        <table class='table' id="accountTrips">
            <?php include 'populateaccounttrips.php'?>
        </table>
    </div>
    <div id="bottom"></div>
</div>


<?php include 'footer.php' ?>
</div>
</body>
</html>
