<?php error_reporting(0);
session_start();
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
    <title>Smart Commute: About</title>

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

<!-- Page Content -->
<div class="content">
    <!--Our Mission-->
        <div class="jumbotron" id="about1">
            <h1 class="pageTitle">About the Program</h1>
        <div class="row" id="ourMission">
            <div class="col-lg-4">
                <img src="images/About%20near%20Mission.jpg" class="contentPic">
            </div>
            <div class="col-lg-8">
                <h2>Our Mission and History</h2>
                <p>Smart Commute Emmet is committed to promoting human powered and sustainable means of travel as a way
                    to improve our health, communities, and planet.<br><br>

                    Now in year <? echo (date("Y")-2009); ?>, Smart Commute continues to do this valuable work. The annual Smart Commute Week
                    and Commuter Cup have become a greatly anticipated and enjoyed event. Smart Commuters enjoy free
                    breakfasts at local restaurants and special discounts at stores.<br><br>

                    In 2017, Smart Commute took things a step further with the addition of a summer-long rewards
                    program. Participants in the rewards program will track their trips and mileage to earn rewards from
                    supporting partners.</p><br>
                <form action='rewards.php' id='indexSignupButton'>
                    <input type='Submit' value='Learn More!' id='signupButton'>
                </form>
            </div>
            </div>
        </div>
    <!--Benefits-->
    <div class="jumbotron" id="about2">
        <div class="row">
            <!--Community Benefits-->
            <div class="col-lg-8" id="benefits">
                <h2>Community Benefits</h2>
                <p>Smart Commuting provides many benefits to the community by encouraging more sustainable forms of
                    travel. Biking, walking, running, or carpooling are ideal ways to reduce traffic and crowding.
                    Smart Commuters help to create more inviting, safer, and more productive town centers. At the
                    same time they are treading more lightly on the planet we all share.<br><br>

                    The reduction in cars places less stress on transportation infrastructure. This has direct cost
                    savings for the community in both roadway maintenance, and the need to sacrifice valuable space
                    for parking. By reducing traffic and crowding we can improve movement and make travel faster for
                    everyone. Using less space for cars opens up the potential for additional bicycle lanes or green
                    spaces.<br><br>

                    Visitors to the area (tourists) and seasonal residents make up a major part of our economy. If
                    less of the people who work in our city centers were driving, the stress on parking would be
                    decreased. This will make visiting our town centers more practical and welcoming. Maximizing
                    space in towns for customers provides local businesses with more potential for growth. It also
                    alleviates a common complaint or excuse that deters people for shopping in town.  </p>
            </div>
            <div class="col-lg-4">
                <img src="images/JansenssFamily.jpg" class="contentPic" id="jansen" alt="A family enjoying the bike trail.">

            </div>
        </div>
    </div>

    <div class="jumbotron" id="about3">
        <div class="row">
            <div class="col-lg-4">
                <img src="images/About%20Near%20Personal%20Benefitstwo.jpg" class="contentPic" alt="A rainbow on the wheelway." id="pbenpic">
            </div>
            <!--Personal Benefits-->
            <div class="col-lg-8" id="personalBenefits">
                <h2>Personal Benefits</h2>
                <p>Human powered commuting provides significant cost savings over car travel. Cars require expensive fuel,
                    insurance, maintenance (oil, tires, brakes), repairs and their acquisition and depreciation costs.
                    The most efficient form of human powered travel is cycling. A well-equipped commuter bike will cost
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
    <!--Smart Commute Week-->
    <div class="jumbotron" id="about4">
        <div class="row">
            <div class="col-lg-7" id="smartCommuteWeek">
                <?php
                include 'dbconnect.php';
                $query5 = "SELECT DATE_FORMAT(`startDate`,'%M %D') AS date FROM Dates";
                mysqli_query($db,$query5);
                $result5 = mysqli_query($db,$query5);
                while($row = mysqli_fetch_array($result5)) {
                    echo "<h2>Smart Commute Week starts {$row['date']} </h2>";
                }?>
                <p>Smart Commute Emmet encourages you to get fit, be green and save money during year <? echo (date("Y")-2009); ?> of Emmet County’s annual
                    Smart Commute Week. Each year, the Top of Michigan Trails Council celebrates the opportunities to
                    utilize pedal and foot power to get from “point a to point b” during Smart Commute Week.<br><br>

                    Live too far from your destination? Use a Smart Lot.There are multiple Smart Lots available throughout
                    Harbor Springs and Petoskey, and they’re designed to allow Smart Commuters a place to park their
                    vehicle in a safe location. Use the Smart Lot to jumpstart your alternative commuting method of
                    carpooling, walking, or biking the rest of the way to your destination. Many Smart Commuters
                    choose a Smart Lot located on or near the connected trail systems that link Harbor Springs to
                    Charlevoix, and most recently, Alanson to Petoskey.<br><br>

                    Ready to bike commute but need a bike, some commuter gear, or some mechanical help? Stop by
                    <a href="http://www.latitude45.com" target="_blank" style="color:darkorange;">Latitude 45 Bicycles and Fitness</a> in Petoskey for a tune-up or a new ride.
                        Either way their friendly and professional staff will help make your riding successful. <br><br>

                    Get your kids involved too. Smart Commute week is a perfect opportunity to talk to your children
                    about actively commuting to school. There are many ways kids can get a little fresh air before the
                    school bell rings, and it will benefit more than just their health. Safe Routes to School programs
                    have shown that when kids have a safe way to actively commute to school, traffic jams are eased,
                    air pollution is decreased, and students are more ready to learn each day. If you live close enough
                    to school, have them walk or bike with neighbors and friends, or if you’re too far outside of town,
                    you can drop them off 1/2 mile away from the school so they can walk the rest of the way.  </p><br><br>

            </div>
            <!-- Google maps API for displaying Smart Lots -->
            <div class="col-lg-5">
                <div id="googlemaps">
                    <h2>Smart Lot Locations:</h2>
                    <div id="map"></div>
                    <script>
                        function initMap() {
                            //Create Marker Coordinates
                            var petoskey = {lat: 45.391862, lng: -84.918852};
                            var bearRiver = {lat:45.364791 , lng:-84.962198};
                            var harbor = {lat:45.427690 , lng:-84.913011};
                            var eastPark ={lat:45.369330 , lng:-85.003738};
                            //Create the map, set zoom and center.
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 11,
                                center: petoskey
                            });
                            //Set the markers to the marker coordinates
                            var markerPetoskey = new google.maps.Marker({
                                position: petoskey,
                                map: map
                            });
                            var markerBearRiver = new google.maps.Marker({
                                position: bearRiver,
                                map: map
                            });
                            var markerHarbor = new google.maps.Marker({
                                position: harbor,
                                map: map
                            });
                            var markerEastPark = new google.maps.Marker({
                                position: eastPark,
                                map: map
                            });
                            //Create info windows that open on click
                            var contentHarbor = '<div id="content">'+
                                '<div id="siteNotice">'+
                                '</div>'+
                                '<h2 id="firstHeading" class="firstHeading" style="background-color:darkcyan;">Harbor Springs</h2>'+
                                '<div id="bodyContent">'+
                                '<p style="color:black;">Little Traverse Township Park</p>'+
                                '<a href="http://www.michiganwatertrails.org/location.asp?ait=av&aid=1029" target="_blank">View more information about this area.</a>'+

                                '</div>'+
                                '</div>';

                            var infowindowHarbor = new google.maps.InfoWindow({
                                content: contentHarbor
                            });

                            markerHarbor.addListener('click', function() {
                                infowindowHarbor.open(map, markerHarbor);
                            });

                            var contentPetoskey = '<div id="content">'+
                                '<div id="siteNotice">'+
                                '</div>'+
                                '<h2 id="firstHeading" class="firstHeading" style="background-color:darkcyan;">Petoskey</h2>'+
                                '<div id="bodyContent">'+
                                '<p style="color:black;">Tannery Creek Trailhead</p>'+
                                '<a href="http://www.michiganwatertrails.org/location.asp?ait=av&aid=695" target="_blank">View more information about this area.</a>'+

                                '</div>'+
                                '</div>';

                            var infowindowPetoskey = new google.maps.InfoWindow({
                                content: contentPetoskey
                            });

                            markerPetoskey.addListener('click', function() {
                                infowindowPetoskey.open(map, markerPetoskey);
                            });

                            var contentEastPark = '<div id="content">'+
                                '<div id="siteNotice">'+
                                '</div>'+
                                '<h2 id="firstHeading" class="firstHeading" style="background-color:darkcyan;">Bay Harbor</h2>'+
                                '<div id="bodyContent">'+
                                '<p style="color:black;">East Park</p>'+
                                    '<a href="http://www.michiganwatertrails.org/location.asp?ait=av&aid=691" target="_blank">View more information about this area.</a>'+
                                '</div>'+
                                '</div>';

                            var infowindowEastPark = new google.maps.InfoWindow({
                                content: contentEastPark
                            });

                            markerEastPark.addListener('click', function() {
                                infowindowEastPark.open(map, markerEastPark);
                            });

                            var contentBearRiver = '<div id="content">'+
                                '<div id="siteNotice">'+
                                '</div>'+
                                '<h2 id="firstHeading" class="firstHeading" style="background-color:darkcyan;">Petoskey</h2>'+
                                '<div id="bodyContent">'+
                                '<p style="color:black;">Bear River Recreation Area</p>'+
                                '<a href="http://www.petoskey.us/departments/parks-a-recreation/community-parks/bear-river-valley-recreation-area" target="_blank">View more information about this area.</a>'+
                                '</div>'+
                                '</div>';

                            var infowindowBearRiver = new google.maps.InfoWindow({
                                content: contentBearRiver
                            });

                            markerBearRiver.addListener('click', function() {
                                infowindowBearRiver.open(map, markerBearRiver);
                            });

                        }


                    </script>
                    <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBROwPng2i6c46iA9Sk3ST120IYiLn6Mtw&callback=initMap">
                    </script>
                    <!--Free breakfast-->
                </div>
                <h2>FREE BREAKFAST</h2>
                <p>Free breakfasts abound for Smart Commuters Monday-Thursday at the following locations
                    (please note that times vary at each location):
                <ul class="list">
                    <li>Johan's of Petoskey and Harbor Springs</li>
                    <li>Grain Train, Mitchell Street, Petoskey: 6:30 – 10 am</li>
                    <li>Roast & Toast, Lake Street & Burns Bldg, Petoskey: 7 – 11 am</li>
                    <li>Johan's Burger Express on (M 119)</li>
                    <li>Crooked Tree Breadworks, M119, Petoskey: 8 - 10 am</li>
                </ul><br>
                *At breakfast locations you will need to submit your filled-out breakfast voucher.
                </p>
            </div>
        </div>
        </div>
    <!--Certification -->
    <div class="jumbotron" id="about5">
        <div class="row">
            <div class="col-lg-12" id="certified">
                <h2>Smart Commute Certified Organizations (formerly Commuter Cup)</h2>
                <p>Organizations and teams with a high level of participation can earn a certification for their efforts. The requirements are scaled for different size
                    organizations and certification will come in 4 levels: Bronze, Silver, Gold, and Platinum.
                    Recognition will be given to all of the teams that reach the various levels of certification.</p><br><br>
                <p>Team leaders, your role this year is very simple!</p>
                <ul class="list">
                    <li>Contact admin@trailscouncil.org by June 1st to sign up your organization and indicate your number of members. </li>
                    <li>Help your members create an account <a href="signup.php" target="_blank" style="color:darkorange;">here</a>. Make sure they select your organization.</li>
                    <li>Use any means necessary to get your team members to log their smart commute trips on Smartcommuteemmet.org. </li>
                    <li>Distribute breakfast vouchers. </li>
                </ul>
                <p style="padding:10px;">We will total up trips at the end of the week to determine your organization's certification level
                    and email you your electronic award, which can be proudly displayed online and/or printed.
                    Below are the required number of trips:</p>
                <div class='table-responsive' id="rewardTable">
                    <table class="table">
                        <tr>
                            <th> </th>
                            <th>Micro (2-4)</th>
                            <th>Mini (5-7)</th>
                            <th>Small (8-11)</th>
                            <th>Medium (12-16)</th>
                            <th>Med/Large (17-22)</th>
                            <th>Large (23-46)</th>
                            <th>X-Large (47-70)</th>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Bronze</td>
                            <td>7</td>
                            <td>16</td>
                            <td>26</td>
                            <td>38</td>
                            <td>53</td>
                            <td>55</td>
                            <td>94</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Silver</td>
                            <td>10</td>
                            <td>22</td>
                            <td>34</td>
                            <td>50</td>
                            <td>70</td>
                            <td>83</td>
                            <td>140</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Gold</td>
                            <td>12</td>
                            <td>27</td>
                            <td>43</td>
                            <td>63</td>
                            <td>88</td>
                            <td>110</td>
                            <td>187</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Platinum</td>
                            <td>14</td>
                            <td>32</td>
                            <td>51</td>
                            <td>76</td>
                            <td>105</td>
                            <td>138</td>
                            <td>234</td>
                        </tr>
                    </table>
                    <p>Note: Large and X-Large organizations can form smaller sub-groups based on department. For example:
                    McLaren Hospital - Human Resources.</p>
                </div>
            </div>

        </div>
    </div>
    <!--Sponsors-->
    <div class="jumbotron" id="about4">
        <div class="row">
            <div class="col-lg-12" id="sponsors">
        <h2>Organizers</h2>
                <p>Smart Commute Emmet is a project coordinated by Top of Michigan Trails Council, with help from a
                    committee of community members. This year’s committee consisted of Jeff Winegard and Sue Bouwense
                    of the Trails Council, Emily Hughes of Little Traverse Conservancy, Joe Graham of Latitude 45 Bicycles and Fitness,
                    Amy Socolovitch of McLaren Northern Michigan, Lynne DeMoor of the Health Department of Northwest Michigan, Megan Goedge of Petoskey District Library,
                    and Mindy Taylor of Grain Train Natural Foods. A special thanks to North Central
                    Michigan College student Robert Heinbokel for developing the new Smart Commute Website. </p>
                <h3>Rewards and Prizes provided by</h3>
                <p><a href="http://www.latitude45.com" target="_blank">Latitude 45 Bicycles and Fitness</a><br>
                    <a href="http://www.bearcuboutfitters.com" target="_blank">Bearcub Outfitters</a><br>
                    <a href="http://www.mcleanandeakin.com" target="_blank">McLean and Eakin Booksellers</a><br>
                    <a href="https://graintrain.coop"target="_blank">Grain Train Natural Foods Markets</a><br>
                    <a href="https://www.breadworks.com"target="_blank">Crooked Tree Breadworks</a><br>
                    <a href="http://yogaroots.com"target="_blank">Yoga Roots</a></p>
                <h3>Smart Commute Week Breakfasts provided by</h3>
                <p><a href="https://graintrain.coop"target="_blank">Grain Train Natural Foods Markets</a><br>
                    <a href="http://www.roastandtoast.com"target="_blank">Roast and Toast</a><br>
                    <a href="https://gtpie.com"target="_blank">Johan's Burger Express & Johan's of Petoskey and Harbor Springs</a><br>
                    <a href="https://www.breadworks.com"target="_blank">Crooked Tree Breadworks</a>
                </p>
                <h3>Financial Support provided by</h3>
                <p>
                    <img src="images/health%20department.jpg" alt="Health Department of NorthWest Michigan." class="logo"><br>
                    <a href="http://www.nwhealth.org"target="_blank">Health Department of NW Michigan</a><br>
                </p>
            </div>

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