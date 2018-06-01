

<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {

    include 'dbconnect.php';

    $tripID = $_POST['tripID'];

    $query = "DELETE FROM smartcommuteemmet.Trip
    WHERE tripID='$tripID'
    ";
    $result = mysqli_query($db, $query);
    if($result){
        header("location: account.php");
    }

    echo ("Error:" . mysqli_error($db));

}
?>