<?php

include 'dbconnect.php';


$query = "SELECT * FROM PlaceEmployed ORDER BY placeEmployedName";
mysqli_query($db, $query);

$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_array($result)){
    echo '<option value="'.$row['placeEmployedName'].'" />'.$row['placeEmployedName'].'</option>';
}

?>