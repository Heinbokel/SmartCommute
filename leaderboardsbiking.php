<?php error_reporting(0);
include 'dbconnect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['leaderboardCount'] = $_POST['leaderboardCount'];
    if(empty($_POST['yearSearch'])){
        $_SESSION['leaderYear'] = date('Y');
    }else {
        $leaderYear = trim($_POST['yearSearch']);
        $leaderYear = strip_tags($leaderYear);
        $leaderYear = htmlspecialchars($leaderYear);
        $leaderYear = mysqli_real_escape_string($db,$leaderYear);
        $_SESSION['leaderYear'] = $leaderYear;
    }
    header("location:leaderboardsbiking.php");
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="icon" href="images/SMARTCOMMUTELOGO.png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="Michigan Trails Council smart commute rewards program.">
        <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
        <meta name="author" content="Robert Heinbokel">
        <title>Smart Commute: Leaderboards</title>

        <?php include 'doclinks.php' ?>

    </head>
    <body>
    <header>
        <?php include 'navigation.php'?>

        <!-- Include carousel banner-->
        <?php include 'carousel.php'?>

    </header>
    <!-- Modal -->
    <?php include 'loginModal.php' ?>

    <div class="content">
        <div class="jumbotron" id="leaderboardTitle">
            <h1 class="pageTitle">Commuter Progress: Biking</h1>
            <form action="<?=$_SERVER['PHP_SELF']?>" method='POST' style="display:inline;">
                <input type='hidden' value='25' name='leaderboardCount'>
                <input type='submit' value='Show 25' id='loginButton' name='Submit'>
            </form>
            <form action='<?=$_SERVER['PHP_SELF']?>' method='POST' style="display:inline;">
                <input type='hidden' value='50' name='leaderboardCount'>
                <input type='submit' value='Show 50' id='loginButton' name='Submit'>
            </form>
            <form action='<?=$_SERVER['PHP_SELF']?>' method='POST' style="display:inline;">
                <input type='hidden' value='100' name='leaderboardCount'>
                <input type='submit' value='Show 100' id='loginButton'  name='Submit'>
            </form>
            <form action='<?=$_SERVER['PHP_SELF']?>' method='POST' style="display:inline;">
                <input type='hidden' value='18446744073709551615' name='leaderboardCount'>
                <input type='submit' value='Show All' id='loginButton'  name='Submit'>
            </form>
            <br><br>
            <form action='<?=$_SERVER['PHP_SELF']?>' method='POST' style="display:inline;">
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
                <input type='submit' name='Submit'>
            </form>

            <script>
                $()
            </script>
        </div>


        <div class='table-responsive'>
            <table class='table-responsive' id="leaderboards">
                <?php include 'populateleaderboardsbiking.php'?>
            </table>
        </div>

        <h1 class="pageTitle">Commutes by Business: Biking</h1>
        <?php include 'populatebusinessleaderboardsbiking.php';?>


    </div>
    <?php include 'footer.php'?>
    </body>
    </html>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>