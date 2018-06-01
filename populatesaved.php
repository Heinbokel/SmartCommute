<div class='table-responsive'>
    <table class='table' id="savedTrips">
        <?php
        include 'dbconnect.php';
        include 'confirmtripmodal.php';
        include 'confirmdeletemodal.php';

        ?>

        <?php
        //Step2
        $query = "select * from Trip where userID = '".$_SESSION['user']."' AND saved =1";
        mysqli_query($db, $query);
        $result = mysqli_query($db, $query);
        $i = 1;

        $arr_m = array("January","February","March","April","May","June","July","August","September","October","November","December");
        $month = date('m');
        for ($m = 6; $m<=$month;$m++){
            $name = $arr_m[$m-1];
            $sel = ($m == $month) ? 'selected ="selected"' : '';
            $optionStringMonth .= "<option value='$m' $sel>$name</option>";
        }

        $day = date('d');
        if(date('m') == 6){
            $dd = 5;
        }else{
            $dd = 1;
        }
        for ($d = $dd; $d<=$day;$d++){
            $sel = ($d == $day) ? 'selected ="selected"' : '';
            $optionStringDay .= "<option value='$d'$sel>$d</option>";
        }

        $year = date('Y');
        echo "
<tr>
      <th>Trip Number</th>
      <th>Trip Name</th>
      <th>Start Point</th>
      <th>End Point</th>
      <th>Miles</th>
      <th>Method</th>
      <th>Description</th>
      <th>Date</th>
      <th></th>
      </tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "
        <tr id='$i'>
        <td data-title='Trip Number'>$i</td>
        <td data-title='Trip Name'>" . $row['tripName'] . "</td>
        <td data-title='Start Point'>" . $row['startPoint'] . "</td>
        <td data-title='End Point'>" . $row['endPoint'] . "</td>
        <td data-title='Miles'>" . $row['tripMiles'] . "</td>
        <td data-title='Method'>" . $row['methodOfTravel'] . "</td>
        <td data-title='Description'>" . $row['description'] . "</td>
        <td data-title='Date'>" . $row['tripDate'] . "</td>
        <td data-title='Reuse'>
        <form action='insertsaved.php' method='POST' id='reuseForm'>
        <input type='hidden' value='{$row['tripID']}' name='tripID'>
        <input type='submit' value='Re-use' id='reuseSubmit' class='reuseSubmit' name='reuseSubmit'><br>
        <select name='dateCommuteMonth' class='dateCommuteMonth' id='dateCommuteMonthSaved'>
        $optionStringMonth
        </select>
        <select class='dateCommuteDay' name='dateCommuteDay' id='dateCommuteDaySaved'>
        $optionStringDay
        </select>
        <select name='dateCommuteYear' class='dateCommuteYear'>
        <option value='$year'>$year</option>
        </select>
        </form>
        </td>
        <td data-title='Delete'>
        <form action='deletesaved.php' method='POST'>
        <input type='hidden' value='{$row['tripID']}' name='tripID'>
        <input type='submit' value='Delete' id='deleteSaved' class='deleteSaved' name='deleteSaved'><br>
 
        </form>
        </td>" . "

        </tr>
        ";
            $i++;
        }
        ?>

        <?php
        //Step 4
        mysqli_close($db);
        ?>

        <script type="text/javascript">
            $(document).ready(function(){
                var CurrentDate=new Date();

                $(".dateCommuteMonth").val(CurrentDate.getMonth()+1);
                $(".dateCommuteDay").val(CurrentDate.getDate());
            });
        </script>
        <script>
            $('.reuseSubmit').on('click', function(e) {
                var $form = $(this).closest('form');
                e.preventDefault();
                $('#confirm').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                    .one('click', '#yes', function(e) {
                        $form.trigger('submit');
                    });
            });
        </script>
        <script>
            $('.deleteSaved').on('click', function(e) {
                var $form = $(this).closest('form');
                e.preventDefault();
                $('#confirmDelete').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                    .one('click', '#yes', function(e) {
                        $form.trigger('submit');
                    });
            });
        </script>
        <!--<script language="JavaScript" type="text/javascript">
            $(document).ready(function(){
                $(".reuseSubmit").click(function(e){
                    if(!confirm('Are you sure you want to reuse this saved commute?')){
                        e.preventDefault();
                        return false;
                    }
                    return true;
                });
            });
        </script>-->

    </table>
</div>