<?php
include 'dbconnect.php';
?>
<?php
//Step2
session_start();
if($_SESSION['leaderboardCount'] ==""){
    $_SESSION['leaderboardCount']=25;
}
if($_SESSION['leaderYear'] ==""){
    $_SESSION['leaderYear']= date('Y');
}
$query = "SELECT 
             SUM(tripMiles) AS totalMiles,
             COUNT(tripID) AS totalTrips,
             COUNT( IF( methodOfTravel = \"Running\", 1, NULL ) )AS running,
             tripID,
             User.fName,
             User.lName
             FROM Trip
             LEFT JOIN User ON User.userID = Trip.userID
             WHERE YEAR(tripDate) = {$_SESSION['leaderYear']} AND
             methodOfTravel = \"Running/Walking\"
             
             GROUP BY User.userID
             ORDER BY totalMiles DESC
             LIMIT {$_SESSION['leaderboardCount']}";
mysqli_query($db, $query);
$result = mysqli_query($db, $query);

$query2 = "SELECT COUNT(userID) as userCount FROM User";
mysqli_query($db,$query2);
$result2 = mysqli_query($db,$query2);

while ($row = mysqli_fetch_array($result2)) {
    echo"<h3>Total Users: " .$row['userCount'] . "<br>For Year: " .$_SESSION['leaderYear']."</h3>";
}
echo "
<tr>
      <th>Name</th>
      <th>Running Commutes</th>
      <th>Miles</th>

      
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
