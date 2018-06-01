<?php
include 'dbconnect.php';
session_start();
if($_SESSION['leaderYear'] ==""){
    $_SESSION['leaderYear']= date('Y');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['yearSearch'])) {
        $_SESSION['leaderYear'] = date('Y');
    } else {
        $leaderYear = trim($_POST['yearSearch']);
        $leaderYear = strip_tags($leaderYear);
        $leaderYear = htmlspecialchars($leaderYear);
        $leaderYear = mysqli_real_escape_string($db, $leaderYear);
        $_SESSION['leaderYear'] = $leaderYear;
    }
}
//Step2
$query = "SELECT * 
FROM Trip 
WHERE YEAR(tripDate) = {$_SESSION['leaderYear']} AND
userID = '".$_SESSION['user']."'";
mysqli_query($db, $query);

$result = mysqli_query($db, $query);
$i = 1;

echo "
<tr>
      <th>Trip Number</th>
      <th>Trip Name</th>
      <th>Start Point</th>
      <th>End Point</th>
      <th>Miles</th>
      <th>Method</th>
      <th>Description</th>
      <th>Date</th>
      <th></th>
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
        <td data-title='Trip Number'>$i</td>
        <td data-title='Trip Name'>" . $row['tripName'] . "</td>
        <td data-title='Start Point'>" . $row['startPoint'] . "</td>
        <td data-title='End Point'>" . $row['endPoint'] . "</td>
        <td data-title='Miles'>" . $row['tripMiles'] . "</td>
        <td data-title='Method'>" . $row['methodOfTravel'] . "</td>
        <td data-title='Description'>" . $row['description'] . "</td>
        <td data-title='Date'>" . $row['tripDate'] . "</td>
        <td data-title='Delete'>
        <form action='deletetrip.php' method='POST'>
        <input type='hidden' value='{$row['tripID']}' name='tripID'>
        <input type='submit' value='Delete' id='deleteTrip' class='deleteTrip' name='deleteTrip' >
        </form>
        </td>
        </tr>
        ";
    $i++;
}
?>
<script>
    $('.deleteTrip').on('click', function(e) {
        var $form = $(this).closest('form');
        e.preventDefault();
        $('#confirmDeleteTrip').modal({
            backdrop: 'static',
            keyboard: false
        })
            .one('click', '#yes', function(e) {
                $form.trigger('submit');
            });
    });
</script>
<?php
//Step 4
mysqli_close($db);
?>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>
