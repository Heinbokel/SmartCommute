<h2>Enter your trip details:</h2>
<div id="savedTrips" class="collapse">
    <?php
    $query5 = "SELECT * FROM Dates";
    mysqli_query($db,$query5);
    $result5 = mysqli_query($db,$query5);

    $query6 = "SELECT DAY(startDate) as day FROM Dates";
    mysqli_query($db,$query6);
    $result6 = mysqli_query($db,$query6);
    $rows = mysqli_fetch_assoc($result6);

    while($row = mysqli_fetch_array($result5)) {
        if (strtotime(date('Y-m-d')) < strtotime($row['endDate']) && strtotime(date('Y-m-d')) > strtotime($row['startDate'])) {
            include 'populatesaved.php';
        }else{
            echo "<p>This feature will return when commute entry is enabled this Spring!</p>";
        }
    }?>
    <script>
        $('select[name="dateCommuteMonth"]').on('change',function(){
            console.log("Changed Month Saved Commutes");
            var select2 = document.getElementById("dateCommuteMonthSaved");
            var month2 = select2.options[select2.selectedIndex].text;
            var daySelects = document.getElementsByClassName('dateCommuteDay');
            var monthSelects = document.getElementsByClassName('dateCommuteMonth');
            var startDate = "<?php echo $rows['day']; ?>";
            console.log("SELECT2 EQUALS: "+select2);
            console.log("MONTH2 EQUALS: "+month2);
            if(month2 == "June") {
                console.log("MONTH IS JUNE");
                var month = new Date();
                month = month.getMonth();
                console.log(month);
                if(month == 5) {
                    var date = new Date().getDate();
                    console.log(date);
                    var dateString = '';
                    for (i = startDate; i <= date; i++) {
                        dateString += '<option value=' + i + '>' + i + '</option>';
                    }
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = dateString;
                    });
                }else {
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML =
                            '<option value=4>4</option>' +
                            '<option value=5>5</option>' +
                            '<option value=6>6</option>' +
                            '<option value=7>7</option>' +
                            '<option value=8>8</option>' +
                            '<option value=9>9</option>' +
                            '<option value=10>10</option>' +
                            '<option value=11>11</option>' +
                            '<option value=12>12</option>' +
                            '<option value=13>13</option>' +
                            '<option value=14>14</option>' +
                            '<option value=15>15</option>' +
                            '<option value=16>16</option>' +
                            '<option value=17>17</option>' +
                            '<option value=18>18</option>' +
                            '<option value=19>19</option>' +
                            '<option value=20>20</option>' +
                            '<option value=21>21</option>' +
                            '<option value=22>22</option>' +
                            '<option value=23>23</option>' +
                            '<option value=24>24</option>' +
                            '<option value=25>25</option>' +
                            '<option value=26>26</option>' +
                            '<option value=27>27</option>' +
                            '<option value=28>28</option>' +
                            '<option value=29>29</option>' +
                            '<option value=30>30</option>'
                        ;
                    });
                }
            }else if(month2 == "July"){
                console.log("MONTH IS JULY");
                var month = new Date();
                month = month.getMonth();
                console.log(month);
                if(month == 6) {
                    var date = new Date().getDate();
                    console.log(date);
                    var dateString = '';
                    for (i = 1; i <= date; i++) {
                        dateString += '<option value=' + i + '>' + i + '</option>';
                    }
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = dateString;
                    });
                }else {
                    [].slice.call( daySelects ).forEach(function ( daySelects ) {
                        daySelects.innerHTML = '<option value=1>1</option>' +
                            '<option value=2>2</option>' +
                            '<option value=3>3</option>' +
                            '<option value=4>4</option>' +
                            '<option value=5>5</option>'+
                            '<option value=6>6</option>'+
                            '<option value=7>7</option>' +
                            '<option value=8>8</option>' +
                            '<option value=9>9</option>' +
                            '<option value=10>10</option>'+
                            '<option value=11>11</option>'+
                            '<option value=12>12</option>'+
                            '<option value=13>13</option>'+
                            '<option value=14>14</option>' +
                            '<option value=15>15</option>'+
                            '<option value=16>16</option>' +
                            '<option value=17>17</option>'+
                            '<option value=18>18</option>' +
                            '<option value=19>19</option>'+
                            '<option value=20>20</option>'+
                            '<option value=21>21</option>'+
                            '<option value=22>22</option>'+
                            '<option value=23>23</option>'+
                            '<option value=24>24</option>'+
                            '<option value=25>25</option>'+
                            '<option value=26>26</option>'+
                            '<option value=27>27</option>'+
                            '<option value=28>28</option>'+
                            '<option value=29>29</option>'+
                            '<option value=30>30</option>'+
                            '<option value=31>31</option>'
                        ;
                    });
                }
            }else if(month2 == "August") {
                console.log("MONTH IS AUGUST");
                var month = new Date();
                month = month.getMonth();
                console.log(month);
                if (month == 7) {
                    var date = new Date().getDate();
                    console.log(date);
                    var dateString = '';
                    for (i = 1; i <= date; i++) {
                        dateString += '<option value=' + i + '>' + i + '</option>';
                    }
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = dateString;
                    });
                } else {
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = '<option value=1>1</option>' +
                            '<option value=2>2</option>' +
                            '<option value=3>3</option>' +
                            '<option value=4>4</option>' +
                            '<option value=5>5</option>' +
                            '<option value=6>6</option>' +
                            '<option value=7>7</option>' +
                            '<option value=8>8</option>' +
                            '<option value=9>9</option>' +
                            '<option value=10>10</option>' +
                            '<option value=11>11</option>' +
                            '<option value=12>12</option>' +
                            '<option value=13>13</option>' +
                            '<option value=14>14</option>' +
                            '<option value=15>15</option>' +
                            '<option value=16>16</option>' +
                            '<option value=17>17</option>' +
                            '<option value=18>18</option>' +
                            '<option value=19>19</option>' +
                            '<option value=20>20</option>' +
                            '<option value=21>21</option>' +
                            '<option value=22>22</option>' +
                            '<option value=23>23</option>' +
                            '<option value=24>24</option>' +
                            '<option value=25>25</option>' +
                            '<option value=26>26</option>' +
                            '<option value=27>27</option>' +
                            '<option value=28>28</option>' +
                            '<option value=29>29</option>' +
                            '<option value=30>30</option>' +
                            '<option value=31>31</option>'
                        ;
                    });
                }
            }else if(month2 == "September") {
                console.log("MONTH IS SEPTEMBER");
                var month = new Date();
                month = month.getMonth();
                console.log(month);
                if (month == 8) {
                    var date = new Date().getDate();
                    console.log(date);
                    var dateString = '';
                    for (i = 1; i <= date; i++) {
                        dateString += '<option value=' + i + '>' + i + '</option>';
                    }
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = dateString;
                    });
                } else {
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = '<option value=1>1</option>' +
                            '<option value=2>2</option>' +
                            '<option value=3>3</option>' +
                            '<option value=4>4</option>' +
                            '<option value=5>5</option>' +
                            '<option value=6>6</option>' +
                            '<option value=7>7</option>' +
                            '<option value=8>8</option>' +
                            '<option value=9>9</option>' +
                            '<option value=10>10</option>' +
                            '<option value=11>11</option>' +
                            '<option value=12>12</option>' +
                            '<option value=13>13</option>' +
                            '<option value=14>14</option>' +
                            '<option value=15>15</option>' +
                            '<option value=16>16</option>' +
                            '<option value=17>17</option>' +
                            '<option value=18>18</option>' +
                            '<option value=19>19</option>' +
                            '<option value=20>20</option>' +
                            '<option value=21>21</option>' +
                            '<option value=22>22</option>' +
                            '<option value=23>23</option>' +
                            '<option value=24>24</option>' +
                            '<option value=25>25</option>' +
                            '<option value=26>26</option>' +
                            '<option value=27>27</option>' +
                            '<option value=28>28</option>' +
                            '<option value=29>29</option>' +
                            '<option value=30>30</option>'
                        ;
                    });
                }
            }else if(month2 == "October") {
                console.log("MONTH IS OCTOBER");
                var month = new Date();
                month = month.getMonth();
                console.log(month);
                if (month == 9) {
                    var date = new Date().getDate();
                    console.log(date);
                    var dateString = '';
                    for (i = 1; i <= date; i++) {
                        dateString += '<option value=' + i + '>' + i + '</option>';
                    }
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = dateString;
                    });
                } else {
                    [].slice.call(daySelects).forEach(function (daySelects) {
                        daySelects.innerHTML = '<option value=1>1</option>' +
                            '<option value=2>2</option>' +
                            '<option value=3>3</option>' +
                            '<option value=4>4</option>' +
                            '<option value=5>5</option>' +
                            '<option value=6>6</option>' +
                            '<option value=7>7</option>' +
                            '<option value=8>8</option>' +
                            '<option value=9>9</option>' +
                            '<option value=10>10</option>' +
                            '<option value=11>11</option>' +
                            '<option value=12>12</option>' +
                            '<option value=13>13</option>' +
                            '<option value=14>14</option>' +
                            '<option value=15>15</option>' +
                            '<option value=16>16</option>' +
                            '<option value=17>17</option>' +
                            '<option value=18>18</option>' +
                            '<option value=19>19</option>' +
                            '<option value=20>20</option>' +
                            '<option value=21>21</option>' +
                            '<option value=22>22</option>' +
                            '<option value=23>23</option>' +
                            '<option value=24>24</option>' +
                            '<option value=25>25</option>' +
                            '<option value=26>26</option>' +
                            '<option value=27>27</option>' +
                            '<option value=28>28</option>' +
                            '<option value=29>29</option>' +
                            '<option value=30>30</option>'+
                            '<option value=31>31</option>'
                        ;
                    });
                }
            }
        });
    </script>
</div>
<input type="button" data-toggle="collapse" data-target="#savedTrips" value="Saved Trips" id="signupButton">


<input type="button" data-toggle="collapse" data-target="#rules" value="Rules" id="signupButton">
<div id="rules" class="collapse">
    <ul class="list">
        <li>You may earn up to two trips per day.</li>
        <li>Maximum of 20 miles per trip.</li>
        <li>Count any trip that you would make in a car. Ex: your trip to work, the grocery store, or school.</li>
        <li>For carpooling there must be a minimum of 3 passengers.</li>

    </ul>
</div>

</div>

<form class="form-horizontal" id="commuteEntryForm" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    <div class="form-group">
        <h1 id="outputTest"></h1>
        <label class="control-label col-sm-2" for="dateCommute">Date of Commute:</label>
        <div class="col-sm-10">
            <select class="form-control" id="dateCommute" name="dateCommuteMonth">
                <?php
                $arr_m = array("January","February","March","April","May","June","July","August","September","October","November","December");
                $month = date('m');
                for ($i = 6; $i<=$month;$i++){
                    $name = $arr_m[$i-1];
                    $sel = ($i == $month) ? 'selected ="selected"' : '';
                    echo "<option value=\"$i\"$sel>$name</option>";
                }
                ?>
            </select>
            <select class="form-control" id="dateCommuteDay" name="dateCommuteDay">
                <?php
                if(date('m') == 6){
                    $dd = 5;
                }else{
                    $dd = 1;
                }
                $day = date('d');
                for ($i = $dd; $i<=$day;$i++){
                    $sel = ($i == $day) ? 'selected ="selected"' : '';
                    echo "<option value=\"$i\"$sel>$i</option>";
                }
                ?>

            </select>
            <script>
                $('select[name="dateCommuteMonth"]').on('change',function(){
                    var select = document.getElementById("dateCommute");
                    var month = select.options[select.selectedIndex].text;
                    var startDate = "<?php echo $rows['day']; ?>";
                    if(month == "June") {
                        console.log("MONTH IS JUNE");
                        var month = new Date();
                        month = month.getMonth();
                        console.log(month);
                        if(month == 5) {
                            var date = new Date().getDate();
                            console.log(date);
                            var dateString = '';
                            for (i = startDate; i <= date; i++) {
                                dateString += '<option value=' + i + '>' + i + '</option>';
                            }
                            document.getElementById('dateCommuteDay').innerHTML = dateString;
                        }else {
                            document.getElementById('dateCommuteDay').innerHTML =
                                '<option value=4>4</option>' +
                                '<option value=5>5</option>' +
                                '<option value=6>6</option>' +
                                '<option value=7>7</option>' +
                                '<option value=8>8</option>' +
                                '<option value=9>9</option>' +
                                '<option value=10>10</option>' +
                                '<option value=11>11</option>' +
                                '<option value=12>12</option>' +
                                '<option value=13>13</option>' +
                                '<option value=14>14</option>' +
                                '<option value=15>15</option>' +
                                '<option value=16>16</option>' +
                                '<option value=17>17</option>' +
                                '<option value=18>18</option>' +
                                '<option value=19>19</option>' +
                                '<option value=20>20</option>' +
                                '<option value=21>21</option>' +
                                '<option value=22>22</option>' +
                                '<option value=23>23</option>' +
                                '<option value=24>24</option>' +
                                '<option value=25>25</option>' +
                                '<option value=26>26</option>' +
                                '<option value=27>27</option>' +
                                '<option value=28>28</option>' +
                                '<option value=29>29</option>' +
                                '<option value=30>30</option>'
                            ;
                        }
                    }else if(month == "July"){
                        console.log("MONTH IS JULY");
                        var month = new Date();
                        month = month.getMonth();
                        console.log(month);
                        if(month == 6) {
                            var date = new Date().getDate();
                            console.log(date);
                            var dateString = '';
                            for (i = 1; i <= date; i++) {
                                dateString += '<option value=' + i + '>' + i + '</option>';
                            }
                            document.getElementById('dateCommuteDay').innerHTML = dateString;
                        }else {
                            document.getElementById('dateCommuteDay').innerHTML =
                                '<option value=1>1</option>' +
                                '<option value=2>2</option>' +
                                '<option value=3>3</option>' +
                                '<option value=4>4</option>' +
                                '<option value=5>5</option>' +
                                '<option value=6>6</option>' +
                                '<option value=7>7</option>' +
                                '<option value=8>8</option>' +
                                '<option value=9>9</option>' +
                                '<option value=10>10</option>' +
                                '<option value=11>11</option>' +
                                '<option value=12>12</option>' +
                                '<option value=13>13</option>' +
                                '<option value=14>14</option>' +
                                '<option value=15>15</option>' +
                                '<option value=16>16</option>' +
                                '<option value=17>17</option>' +
                                '<option value=18>18</option>' +
                                '<option value=19>19</option>' +
                                '<option value=20>20</option>' +
                                '<option value=21>21</option>' +
                                '<option value=22>22</option>' +
                                '<option value=23>23</option>' +
                                '<option value=24>24</option>' +
                                '<option value=25>25</option>' +
                                '<option value=26>26</option>' +
                                '<option value=27>27</option>' +
                                '<option value=28>28</option>'+
                                '<option value=29>29</option>'+
                                '<option value=30>30</option>'+
                                '<option value=31>31</option>'
                            ;
                        }
                    }else if(month == "August"){
                        console.log("MONTH IS AUGUST");
                        var month = new Date();
                        month = month.getMonth();
                        console.log(month);
                        if(month == 7) {
                            var date = new Date().getDate();
                            console.log(date);
                            var dateString = '';
                            for (i = 1; i <= date; i++) {
                                dateString += '<option value=' + i + '>' + i + '</option>';
                            }
                            document.getElementById('dateCommuteDay').innerHTML = dateString;
                        }else {
                            document.getElementById('dateCommuteDay').innerHTML =
                                '<option value=1>1</option>' +
                                '<option value=2>2</option>' +
                                '<option value=3>3</option>' +
                                '<option value=4>4</option>' +
                                '<option value=5>5</option>' +
                                '<option value=6>6</option>' +
                                '<option value=7>7</option>' +
                                '<option value=8>8</option>' +
                                '<option value=9>9</option>' +
                                '<option value=10>10</option>' +
                                '<option value=11>11</option>' +
                                '<option value=12>12</option>' +
                                '<option value=13>13</option>' +
                                '<option value=14>14</option>' +
                                '<option value=15>15</option>' +
                                '<option value=16>16</option>' +
                                '<option value=17>17</option>' +
                                '<option value=18>18</option>' +
                                '<option value=19>19</option>' +
                                '<option value=20>20</option>' +
                                '<option value=21>21</option>' +
                                '<option value=22>22</option>' +
                                '<option value=23>23</option>' +
                                '<option value=24>24</option>' +
                                '<option value=25>25</option>' +
                                '<option value=26>26</option>' +
                                '<option value=27>27</option>' +
                                '<option value=28>28</option>'+
                                '<option value=29>29</option>'+
                                '<option value=30>30</option>'+
                                '<option value=31>31</option>'
                            ;
                        }
                    }else if(month == "September"){
                        console.log("MONTH IS September");
                        var month = new Date();
                        month = month.getMonth();
                        console.log(month);
                        if(month == 8) {
                            var date = new Date().getDate();
                            console.log(date);
                            var dateString = '';
                            for (i = 1; i <= date; i++) {
                                dateString += '<option value=' + i + '>' + i + '</option>';
                            }
                            document.getElementById('dateCommuteDay').innerHTML = dateString;
                        }else {
                            document.getElementById('dateCommuteDay').innerHTML =
                                '<option value=1>1</option>' +
                                '<option value=2>2</option>' +
                                '<option value=3>3</option>' +
                                '<option value=4>4</option>' +
                                '<option value=5>5</option>' +
                                '<option value=6>6</option>' +
                                '<option value=7>7</option>' +
                                '<option value=8>8</option>' +
                                '<option value=9>9</option>' +
                                '<option value=10>10</option>' +
                                '<option value=11>11</option>' +
                                '<option value=12>12</option>' +
                                '<option value=13>13</option>' +
                                '<option value=14>14</option>' +
                                '<option value=15>15</option>' +
                                '<option value=16>16</option>' +
                                '<option value=17>17</option>' +
                                '<option value=18>18</option>' +
                                '<option value=19>19</option>' +
                                '<option value=20>20</option>' +
                                '<option value=21>21</option>' +
                                '<option value=22>22</option>' +
                                '<option value=23>23</option>' +
                                '<option value=24>24</option>' +
                                '<option value=25>25</option>' +
                                '<option value=26>26</option>' +
                                '<option value=27>27</option>' +
                                '<option value=28>28</option>'+
                                '<option value=29>29</option>'+
                                '<option value=30>30</option>'
                            ;
                        }
                    }else if(month == "October"){
                        console.log("MONTH IS October");
                        var month = new Date();
                        month = month.getMonth();
                        console.log(month);
                        if(month == 9) {
                            var date = new Date().getDate();
                            console.log(date);
                            var dateString = '';
                            for (i = 1; i <= date; i++) {
                                dateString += '<option value=' + i + '>' + i + '</option>';
                            }
                            document.getElementById('dateCommuteDay').innerHTML = dateString;
                        }else {
                            document.getElementById('dateCommuteDay').innerHTML =
                                '<option value=1>1</option>' +
                                '<option value=2>2</option>' +
                                '<option value=3>3</option>' +
                                '<option value=4>4</option>' +
                                '<option value=5>5</option>' +
                                '<option value=6>6</option>' +
                                '<option value=7>7</option>' +
                                '<option value=8>8</option>' +
                                '<option value=9>9</option>' +
                                '<option value=10>10</option>' +
                                '<option value=11>11</option>' +
                                '<option value=12>12</option>' +
                                '<option value=13>13</option>' +
                                '<option value=14>14</option>' +
                                '<option value=15>15</option>' +
                                '<option value=16>16</option>' +
                                '<option value=17>17</option>' +
                                '<option value=18>18</option>' +
                                '<option value=19>19</option>' +
                                '<option value=20>20</option>' +
                                '<option value=21>21</option>' +
                                '<option value=22>22</option>' +
                                '<option value=23>23</option>' +
                                '<option value=24>24</option>' +
                                '<option value=25>25</option>' +
                                '<option value=26>26</option>' +
                                '<option value=27>27</option>' +
                                '<option value=28>28</option>'+
                                '<option value=29>29</option>'+
                                '<option value=30>30</option>'+
                                '<option value=31>31</option>'
                            ;
                        }
                    }
                });
            </script>
            <select class="form-control" id="dateCommuteYear" name="dateCommuteYear">
                <?php

                $year = date('Y');
                echo"<option value='$year'>$year</option>";?>
            </select>
            <p id="dateCommuteError" class="errorText"><?php echo $dateCommuteError . $_SESSION['message']; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="travelMethod">Method of Travel:</label>
        <div class="col-sm-10">
            <select class="form-control" id="travelMethod" required="required" name="travelMethod">
                <option>Bicycle</option>
                <option>Running/Walking</option>
                <option>Carpool</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="milesTraveled">Miles Traveled:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="milesTraveled" placeholder="How long was your commute?" required="required" name="milesTraveled">
            <p id="milesTraveledError" class="errorText"><?php echo $milesTraveledError; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="startPoint">Start Point:</label>
        <div class="col-sm-10">
            <select class="form-control" id="startPoint" required="required" name="startPoint">
                <option>Petoskey Downtown</option>
                <option>Petoskey West of Bear River</option>
                <option>Petoskey Other</option>
                <option>Harbor Springs City</option>
                <option>Bear Creek Township</option>
                <option>Resort Township</option>
                <option>SpringVale Township</option>
                <option>Littlefield Township</option>
                <option>Little Traverse Township</option>
                <option>West Traverse Township</option>
                <option>Pleasantview Township</option>
                <option>Friendship Township</option>
                <option>Maple River Township</option>
                <option value="other">OTHER</option>
            </select>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#otherStart').attr('disabled','disabled');
            $('select[name="startPoint"]').on('change',function(){
                var  other = $(this).val();
                if(other == "other"){
                    $('#otherStart').removeAttr('disabled');
                }else{
                    $('#otherStart').attr('disabled','disabled');
                }

            });
        });
    </script>
    <div class="form-group">
        <label class="control-label col-sm-2" for="otherStart">Other:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="otherStart" placeholder="Enter your start point here..."  name="otherStart">
            <p id="otherStartError" class="errorText"><?php echo $otherStartError; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="endPoint">End point:</label>
        <div class="col-sm-10">
            <select class="form-control" id="endPoint" required="required" name="endPoint">
                <option>Petoskey Downtown</option>
                <option>Petoskey West of Bear River</option>
                <option>Petoskey Other</option>
                <option>Harbor Springs City</option>
                <option>Bear Creek Township</option>
                <option>Resort Township</option>
                <option>SpringVale Township</option>
                <option>Littlefield Township</option>
                <option>Little Traverse Township</option>
                <option>West Traverse Township</option>
                <option>Pleasantview Township</option>
                <option>Friendship Township</option>
                <option>Maple River Township</option>
                <option value="other">OTHER</option>
            </select>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#otherEnd').attr('disabled','disabled');
            $('select[name="endPoint"]').on('change',function(){
                var  other = $(this).val();
                if(other == "other"){
                    $('#otherEnd').removeAttr('disabled');
                }else{
                    $('#otherEnd').attr('disabled','disabled');
                }

            });
        });
    </script>
    <div class="form-group">
        <label class="control-label col-sm-2" for="otherEnd">Other:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="otherEnd" placeholder="Enter your end point here..."  name="otherEnd">
            <p id="otherEndError" class="errorText"><?php echo $otherEndError; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="commuteDescription">Commute Description:</label>
        <div class="col-sm-10">
            <textarea id="commuteDescription" placeholder="Enter any notes about your commute here." name="commuteDescription"></textarea>
            <p><span class="errorText"><?php echo $commuteDescriptionError; ?></span></p>

        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-sm-2">
            <label>Save Options?</label>
        </div>
        <div class="col-sm-1">
            <input type="checkbox" value="" id="rememberCommute" name="rememberCommute" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="commuteName">Commute Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="commuteName" placeholder="Enter a unique name to save this commute to your saved commutes." disabled=""  name="commuteName" >
            <span class="errorText"><?php echo $commuteNameError; ?></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" name="commuteSubmit" id="commuteSubmit" value="Submit">Submit</button>
        </div>
    </div>
</form>
<script>
    document.getElementById('rememberCommute').onchange = function() {
        document.getElementById('commuteName').disabled = !this.checked;
    }
</script>

}