<?php
include 'dbconnect.php'
?>
<?php
//Step2
$query = "SELECT SUM(totalMiles) AS totalDistance FROM User";
mysqli_query($db, $query);

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

echo "<h3>Distance Traveled: " . $row['totalDistance'] . " miles.</h3>";
?>
<?php
//Step2
$query = "SELECT SUM(totalTrips) AS totalTrips FROM User";
mysqli_query($db, $query);

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

echo "<h3>Commutes Completed: " . $row['totalTrips'] . " trips.</h3>";
?>

<?php
//Step2
$query = "SELECT SUM(totalMiles)/23 AS gallonsSaved FROM User";
mysqli_query($db, $query);

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

echo "<h3>Gas Saved: " . round($row['gallonsSaved']) . " gallons.</h3>";

echo "<h3>Carbon Reduced: " . round($row['gallonsSaved']*20) . " pounds.</h3>";
?>

<?php
//Step 4
mysqli_close($db);
?>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>
