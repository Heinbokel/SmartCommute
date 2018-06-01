
<?php
session_start();

error_reporting(0);

if($_SESSION['admin'] < 1 || empty($_SESSION['admin'])){
    header("Location:account.php");
}

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="icon" href="images/SmartCommuteLogo.jpg">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="Michigan Trails Council smart commute rewards program.">
        <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
        <meta name="author" content="Robert Heinbokel">
        <title>Michigan Trails Smart Commute: Management Console</title>
    </head>

    <?php include 'doclinks.php' ?>
    <?php include 'confirmdeletebusinessmodal.php'?>

    <body>
    <div class="wrapper">
        <header>
            <?php include 'navigation.php'?>
            <?php include 'navigationmanagementconsole.php' ?>
            <!-- Include the Carousel Banner. -->
            <?php include 'carousel.php'?>

        </header>
        <!-- Include the modal for the login button in the nav bar -->
        <?php include 'loginModal.php' ?>
        <?php

        include 'dbconnect.php';

        $query = "SELECT * FROM PlaceEmployed ORDER BY placeEmployedName";
        mysqli_query($db, $query);

        $result = mysqli_query($db, $query);

        $query2 = "SELECT * FROM User ORDER BY placeEmployed";
        mysqli_query($db, $query2);

        $result2 = mysqli_query($db, $query2);

        if(empty($_POST['yearSearch'])){
            $yearSearch = date('Y');
        }else {
            //set email variable, prevent injection.
            $yearSearch = trim($_POST['yearSearch']);
            $yearSearch = strip_tags($yearSearch);
            $yearSearch = htmlspecialchars($yearSearch);
            $yearSearch = mysqli_real_escape_string($db, $yearSearch);
        }
        if(empty($_POST['monthSearch'])){
            $monthSearch = date('m');
        }else {
            //set email variable, prevent injection.
            $monthSearch = trim($_POST['monthSearch']);
            $monthSearch = strip_tags($monthSearch);
            $monthSearch = htmlspecialchars($monthSearch);
            $monthSearch = mysqli_real_escape_string($db, $monthSearch);
        }
        if(empty($_POST['sortBy'])){
            $sortBy = 'tripID';
        }else {
            $sortBy = $_POST['sortBy'];
        }

        $query3 = "SELECT * FROM Trip 
                   WHERE YEAR(tripDate) = $yearSearch AND 
                   MONTH(tripDate) = $monthSearch
                   ORDER BY $sortBy";
        mysqli_query($db,$query3);

        $result3 = mysqli_query($db,$query3);

        $query4 = "SELECT * FROM Trip
                   JOIN User ON Trip.userID = User.userID
                   WHERE Trip.tripDate >= CURRENT_DATE - INTERVAL DAYOFWEEK(CURRENT_DATE )+13 DAY
                   AND Trip.tripDate < CURRENT_DATE - INTERVAL DAYOFWEEK(CURRENT_DATE )-1 DAY
                   GROUP BY User.userID
                   ORDER BY Trip.tripID DESC
";
        mysqli_query($db,$query4);

        $result4 = mysqli_query($db,$query4);

        $query5 = "SELECT * FROM Dates
";
        mysqli_query($db,$query5);

        $result5 = mysqli_query($db,$query5);
        $result6 = mysqli_query($db,$query5);

        ?>

        <div class="content">
            <div class="jumbotron" id="mainContent1">
<h2 id="business">Add/Remove Businesses</h2>
                <div class="container">
                <div class="row">

                    <!--Add Business-->
                    <div class="col-lg-4">
                        <h3>Add Business:</h3>
                        <form action='addbusiness.php' method='POST'>
                            <label for="addBusiness">Business Name:</label>
                            <input type="text" name="placeEmployedName" id="addBusiness">
                            <input type='submit' value='Submit' id='addBusiness' class='addBusiness' name='addBusiness' >
                        </form>
                    </div>
                    <!--Business List & Delete Business-->
                    <div class="col-lg-8">
                <table class='table-responsive' id="managementTable">
<?php
$i = 1;
echo "
<tr>
      <th>#</th>
      <th>Business</th>
      <th>Captain</th>
      <th>Update Captain</th>
      <th>Delete</th>
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
        <td data-title='#'>$i</td>
        <td data-title='Business'>" .$row['placeEmployedName'] . "</td>
        <td data-title='Captain'>" .$row['captain'] . "</td>
        <td>
        <br>
        <form action='updatecaptain.php' method='POST'>
        <input type='hidden' value='{$row['placeEmployedID']}' name='placeEmployedID'>
        <input type='text' name='captain' placeholder='Type Captain Name Here'>
        <input type='submit' value='Set Captain'  name='updateCaptain' >
        </form>
        <br>
        </td>
        <td data-title='Delete'>
        <form action='deletebusiness.php' method='POST'>
        <input type='hidden' value='{$row['placeEmployedID']}' name='placeEmployedID'>
        <input type='submit' value='Delete' id='deleteTrip' class='deleteBusiness' name='deleteBusiness' >
        </form>
        </td>
        </tr>
        ";
    $i++;
}
?>
                <script>
                    $('.deleteBusiness').on('click', function(e) {
                        var $form = $(this).closest('form');
                        e.preventDefault();
                        $('#confirmDeleteBusiness').modal({
                            backdrop: 'static',
                            keyboard: false
                        })
                            .one('click', '#yes', function(e) {
                                $form.trigger('submit');
                            });
                    });
                </script>

                </table>
                    </div>
                    <div class="row">
                        <!--Active Users-->
                        <div class="col-lg-12">
                            <h2 id="activeUsers">Active Users (2 weeks)</h2>
                            <table class="table-responsive" id="leaderboards" style="border:1px solid white;">
                                <?php
                                $x = 0;
                                echo "
<tr>
      <th></th>
      <th>Name</th>
      </tr>";
                                while ($row = mysqli_fetch_array($result4)) {
                                    $x++;
                                    echo "<tr>
        <td data-title='#'>".$x."</td>
        <td data-title='Name'>" . $row['fName'] . " " . $row['lName'] . "</td>
        
        </tr>
        ";
                                }?>
                            </table>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <!--User List & Edit User-->
                        <div class="col-lg-12">
                            <h2 id="userList">User List</h2>
                            <table class="table-responsive" id="leaderboards" style="border:1px solid white;">
                            <?php
                            echo "
<tr>
      <th>Name</th>
      <th>Email</th>
      <th>Employer</th>
      <th>Update Employer</th>
      </tr>";
                            while ($row = mysqli_fetch_array($result2)) {
                                echo "<tr>
        <td data-title='Name'>" . $row['fName'] . " " . $row['lName'] . "</td>
        <td data-title='Email'>" .$row['email'] . "</td>
        <td data-title='Employer'>". $row['placeEmployed'] . "</td>
        <td>
        <form action='updateplaceemployed.php' method='POST'>
        <input type='hidden' value='{$row['userID']}' name='userID'>
        <input type='text' name='placeEmployed' placeholder='Type new employer here' style='color:black;'>
        <input type='submit' value='Set Employer'  name='updateEmployer' style='color:black;margin-bottom:5px;' >
        </form>
        </td>
        </tr>
        ";
                            }?>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <!--Trip List-->
                        <div class="col-lg-12">
                            <h2 id="tripList">Trip List (<?php echo"$yearSearch-$monthSearch Sorted: $sortBy"?>)</h2>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method='POST' style="display:inline;">
                                <label for="yearsearch">Year:</label>
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
                                <label for="monthSearch">Month:</label>
                                <select id="monthSearch" name="monthSearch" class="dateChange">
                                    <?php
                                    $arr_m = array("January","February","March","April","May","June","July","August","September","October","November","December");
                                    $month = date('m');
                                    for ($i = 1; $i<=12;$i++){
                                        $name = $arr_m[$i-1];
                                        $sel = ($i == $month) ? 'selected ="selected"' : '';
                                        echo "<option value=\"$i\"$sel>$name</option>";
                                    }
                                    ?>
                                </select>
                                <label for="sortBy">Sort:</label>
                                <select name="sortBy" id="sortBy">
                                    <option value="tripID">Trip ID</option>
                                    <option value="startPoint">Start Point</option>
                                    <option value="endPoint">End Point</option>
                                    <option value="tripMiles">Distance</option>
                                    <option value="methodOfTravel">Method of Travel</option>
                                </select>
                                <input type="submit" name="submit" value="submit">
                            </form>
                            <table class="table-responsive" id="leaderboards">
                                <?php
                                echo "
<tr>
      <th>ID</th>
      <th>Start</th>
      <th>End</th>
      <th>Distance</th>
      <th>Method</th>
      <th>Description</th>
      </tr>";
                                while ($row = mysqli_fetch_array($result3)) {
                                    echo "<tr>
        <td data-title='ID'>" . $row['tripID'] . "</td>
        <td data-title='Start'>" .$row['startPoint'] . "</td>
        <td data-title='End'>". $row['endPoint'] . "</td>
        <td data-title='Distance'>". $row['tripMiles'] . "</td>
        <td data-title='Method'>". $row['methodOfTravel'] . "</td>
        <td data-title='Description'>". $row['description'] . "</td>


        </tr>
        ";
                                }?>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <h2 id="dates">Start Date</h2>
                            <?php
                            while($row = mysqli_fetch_array($result5)){
                                echo "<p>Current Start Date: {$row['startDate']}</p>";
                            }
                            ?>
                            <form action="startdatechange.php" method='POST'>
                                <select id="startDateMonth" name="startDateMonth" class="dateChange">
                                    <?php
                                    $arr_m = array("January","February","March","April","May","June","July","August","September","October","November","December");
                                    $month = date('m');
                                    for ($i = 1; $i<=12;$i++){
                                        $name = $arr_m[$i-1];
                                        $sel = ($i == $month) ? 'selected ="selected"' : '';
                                        echo "<option value=\"$i\"$sel>$name</option>";
                                    }
                                    ?>
                                </select>
                                <select name="startDateDay" class="dateChange">
                                    <?php
                                    $day = date('d');
                                    for ($i = 0; $i<=31;$i++){
                                        $sel = ($i == $day) ? 'selected ="selected"' : '';
                                        echo "<option value=\"$i\"$sel>$i</option>";
                                    }
                                    ?>
                                </select>
                                <select name="startDateYear" class="dateChange">
                                    <?php
                                    $year = date('Y', strtotime('+1 years'));
                                    $years = date('Y');
                                    for ($i = $year; $i>=$years;$i--){
                                        $sel = ($i == $year) ? 'selected ="selected"' : '';
                                        echo "<option value=\"$i\"$sel>$i</option>";
                                    }
                                    ?>
                                </select>
                                <input type='submit' value='Submit'  name='submit' style='color:black;margin-bottom:5px;' >
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <h2>End Date</h2>
                            <?php
                            while($row = mysqli_fetch_array($result6)){
                                echo "<p>Current End Date: {$row['endDate']}</p>";
                            }
                            ?>
                            <form action="enddatechange.php" method='POST'>
                                <select id="endDateMonth" name="endDateMonth" class="dateChange">
                                    <?php
                                    $arr_m = array("January","February","March","April","May","June","July","August","September","October","November","December");
                                    $month = date('m');
                                    for ($i = 1; $i<=12;$i++){
                                        $name = $arr_m[$i-1];
                                        $sel = ($i == $month) ? 'selected ="selected"' : '';
                                        echo "<option value=\"$i\"$sel>$name</option>";
                                    }
                                    ?>
                                </select>
                                <select name="endDateDay" class="dateChange">
                                    <?php
                                    $day = date('d');
                                    for ($i = 0; $i<=31;$i++){
                                        $sel = ($i == $day) ? 'selected ="selected"' : '';
                                        echo "<option value=\"$i\"$sel>$i</option>";
                                    }
                                    ?>
                                </select>
                                <select name="endDateYear" class="dateChange">
                                    <?php
                                    $year = date('Y', strtotime('+1 years'));
                                    $years = date('Y');
                                    for ($i = $year; $i>=$years;$i--){
                                        $sel = ($i == $year) ? 'selected ="selected"' : '';
                                        echo "<option value=\"$i\"$sel>$i</option>";
                                    }
                                    ?>
                                </select>
                                <input type='submit' value='Submit'  name='submit' style='color:black;margin-bottom:5px;' >
                            </form>
                        </div>
                    </div>
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