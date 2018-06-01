<?php error_reporting(0); ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/SMARTCOMMUTELOGO.png">

    <meta name="description" content="Michigan Trails Council smart commute rewards program.">
    <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
    <meta name="author" content="Robert Heinbokel">
    <title>Michigan Trails Smart Commute: Sign up</title>

  <?php include 'doclinks.php' ?>

</head>
<body>
<header>
    <?php include 'navigation.php'?>

    <?php include 'carousel.php'?>

</header>
<!-- Modal -->
<?php include 'loginModal.php' ?>

<div class="content">
    <div class="jumbotron" id="mainContent1">
        <h2>There was an error with your log in Email or Password.</h2>
        <p>Please try again.</p>
        <input type="button" value="log in" id="loginButton" data-toggle="modal" data-target="#myModal">

    </div>

</div>
<?php include 'footer.php'?>
</body>
</html>

