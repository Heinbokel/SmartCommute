<?php
include 'dbconnect.php';
?>
<?php
//Step2
session_start();
if($_SESSION['leaderboardCount'] ==""){
    $_SESSION['leaderboardCount']=25;
}
$query = "SELECT * FROM User ORDER BY totalMiles DESC LIMIT {$_SESSION['leaderboardCount']}";
mysqli_query($db, $query);
$result = mysqli_query($db, $query);



echo "
<tr>
      <th>Name</th>
      <th>Commutes</th>
      <th>Miles</th>
      <th>Bike</th>

      
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
        <td data-title='Name'>" . $row['fName'] . " " . $row['lName'] . "</td>
        <td data-title='Trips'>" . $row['totalTrips'] . "</td>
        <td data-title='Miles'>" . $row['totalMiles'] . "</td>


        </tr>
        ";
}
?>

<?php
//Step 4
mysqli_close($db);
?>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>
