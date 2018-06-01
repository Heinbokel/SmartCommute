<?php error_reporting(0); ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Michigan Trails Council smart commute rewards program.">
    <meta name="keywords" content="Michigan, bike, trails, run, smart commute, commute">
    <meta name="author" content="Robert Heinbokel">
    <title>Michigan Trails Smart Commute: Benefits</title>

    <?php include 'doclinks.php' ?>
</head>
<body>
<header>
    <?php include 'navigation.php'?>

    <!--Include carousel banner-->
    <?php include 'carousel.php'?>

</header>
<!-- Modal -->
<?php include 'loginModal.php' ?>

<div class="content">
    <div class="jumbotron" id="mainContent1">
        <h2>The purpose of a Smart Commute:</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8" id="communityBenefits">
                <h2>Community Benefits</h2>
                <p>The forms of travel we are encouraging will create a more inviting, safer, and more productive downtown
                    for Petoskey. By reducing traffic and crowding movement will be faster and safer for everyone.
                    Less space will be necessary for cars, opening up the potential for additional bicycle lanes or greenways.<br><br>

                    Visitors to the area (tourists) and seasonal residents make up a major part of our economy.
                    With less people driving, the stress on parking will decreased. This will make visiting downtown
                    more practical and welcoming. Maximizing space downtown for customers should provide financial benefits
                    to businesses. </p>
            </div>
            <div class="col-lg-4">
                <img src="images/JansenssFamily.jpg" class="contentPic" alt="A family enjoying the bike trail.">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <img src="images/WHEELWAYRAINBOW.jpg" class="contentPic" alt="A rainbow on the wheelway.">

            </div>
            <div class="col-lg-8" id="personalBenefits">
                <h2>Personal Benefits</h2>
                <p>Human powered commuting provides significant cost savings over car travel. Cars require expensive fuel,
                    insurance, maintenance (oil, tires, brakes), repairs and their acquisition and depreciation costs.
                    The most expensive form of human powered travel is cycling. A well-equipped commuter bike will cost
                    less than $600 and maintenance and repair costs are a fraction of those required for cars.<br><br>

                    Many people believe that they don’t have the time to commute by human powered means. While it may
                    take you longer to travel this way, it is likely to a better use of time when you consider the time
                    you spend working to afford a car. For most people the time they spend working to earn money to pay
                    for their cars is greater than the extra time they would spend commuting by slower means of travel.<br><br>

                    Human powered commuting is a more efficient and healthier use of time. Many people do not have the
                    time to consistently workout. By walking or biking to work you are replacing stagnant car travel with
                    enjoyable exercise. In a country where over a third of our population is obese, making exercise a part
                    of our lifestyle is critical. This “double-dip” is very desirable to busy time-crunched parents.  </p>
            </div>
        </div>
</div>
<?php include 'footer.php'?>
</body>
</html>

<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>