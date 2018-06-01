<?php include 'logoutModal.php'?>


<!-- Navigation Bar-->
<nav role="navigation" class="navbar navbar-inverse" id="headerNav">
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
<!--What's stored in the collapsed Hamburger Menu-->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" id="navbarBrand"><img src="images/SMARTCOMMUTELOGO.png" id="navLogo"></a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">About
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" id="headerNav dropdown">
                        <li><a href="about.php">Our Mission</a></li>
                        <li><a href="about.php#benefits">Benefits</a></li>
                        <li><a href="about.php#smartCommuteWeek">Smart Commute Week</a></li>
                        <li><a href="about.php#certified">Certification</a></li>
                        <li><a href="about.php#sponsors">Sponsors</a></li>
                        <li><a href="http://www.trailscouncil.org/donate-top-michigan-trails-council" target="_blank">Donate</a></li>
                    </ul>
                </li>
                <li><a href="rewards.php">Rewards</a></li>
                <li><a href="commuteentry.php">Trip Entry</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Leaderboards
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" id="headerNav dropdown">
                        <li><a href="leaderboards.php">All Leaderboards</a></li>
                        <li><a href="leaderboardsbiking.php">Biking Leaderboards</a></li>
                        <li><a href="leaderboardsrunning.php">Running Leaderboards</a></li>
                        <li><a href="leaderboardscarpool.php">Carpool Leaderboards</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php session_start();
                if(isset($_SESSION['user'])!=""){
                    echo "<li><a href='account.php'>My Account</a></li>
                    <li><a href=''data-toggle='modal' data-target='#logoutModal'>Logout</a></li>";
                }else{
                    echo "<li><a href='signup.php'>Sign Up</a></li>
                <li id='nav-login' data-toggle='modal' data-target='#myModal'><a href='#myModal'>Login</a></li>";
                }?>

            </ul>
        </div>
    </div>
</nav>