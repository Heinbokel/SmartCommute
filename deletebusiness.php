

<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {

    include 'dbconnect.php';

    $placeEmployedID = $_POST['placeEmployedID'];

    $query = "DELETE FROM smartcommuteemmet.PlaceEmployed
    WHERE placeEmployedID='$placeEmployedID'
    ";
    $result = mysqli_query($db, $query);
    if($result){
        header("location: managementconsole.php");
    }

    echo ("Error:" . mysqli_error($db));

}
?>