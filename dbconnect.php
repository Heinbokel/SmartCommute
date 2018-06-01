<?php

//Connect to localhost for development.
//$db = mysqli_connect('localhost','root','','smartcommute');

//Connect to the InfinityFree database for live.
/*
$db = mysqli_connect('sql107.epizy.com','epiz_19853427','joot155','epiz_19853427_TrailsCouncilRewardsDB')
or die('Error connecting to MySQL server.');
*/

//Connect to school db
$db = mysqli_connect('localhost','emmetcommuter','smart','smartcommuteemmet');

//Connect to AMAZON AWS LIVE

//$db = mysqli_connect('trailssmartcommute.chchupszeiix.us-west-2.rds.amazonaws.com:3306','admin','5sbhyh27','TrailsCouncilSmartCommute');

?>