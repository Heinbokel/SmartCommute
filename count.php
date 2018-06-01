<?php
include 'dbconnect.php';
session_start();




//Step2
$query = "
SELECT placeEmployed, SUM(totalTrips) AS commutes, COUNT(placeEmployed) as teamSize, SUM(totalMiles) AS businessMiles
FROM User
GROUP BY placeEmployed
ORDER BY commutes DESC";
mysqli_query($db, $query);
$result = mysqli_query($db, $query);
$i = 1;

$query2 = "SELECT COUNT(DISTINCT placeEmployed) as placeEmployedCount FROM User";
mysqli_query($db,$query2);
$result2 = mysqli_query($db,$query2);

while ($row = mysqli_fetch_array($result2)) {
    echo"<h3>Total Businesses: " .$row['placeEmployedCount'] ."</h3>";
}

echo  "<table class='table-responsive' id='leaderboards'>
<tr>
      <th>Total Trips</th>
      <th>Miles Traveled</th>
      <th>Employer</th>
      <th>Team Size</th>
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
        <td>" . $row['commutes'] . "</td>
        <td>" . $row['businessMiles'] . "</td>
        <td>" . $row['placeEmployed'] . "</td>
                <td>" . $row['teamSize'] . "</td>
                

        </tr>
        ";
    $i++;
}


?>
</table>
<?php
//Step 4
mysqli_close($db);
?>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>
