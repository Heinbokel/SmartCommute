

<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {

    include 'dbconnect.php';

    $tripID = $_POST['tripID'];

    $query = "UPDATE smartcommuteemmet.Trip
    SET saved=0
    WHERE tripID='$tripID'
    ";
    $result = mysqli_query($db, $query);
    if($result){
        header("location: account.php");
    }

    echo ("Error:" . mysqli_error($db));

}
?>