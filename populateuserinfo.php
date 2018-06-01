<div class='table-responsive'>
    <table class='table' id="userInfo">
        <?php
        include 'dbconnect.php';
        ?>
        <?php
        //Step2
        session_start();

        $query = "SELECT * FROM User WHERE userID = '{$_SESSION['user']}'";
        mysqli_query($db, $query);

        $result = mysqli_query($db, $query);
        $i = 1;

        echo "
<tr>
      <th>Name</th>
      <th>Email</th>
      <th>Date of Birth</th>
      <th>Employer</th>
      <th>Address</th>
      <th>Edit</th>
      </tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>
        <td data-title='Name'>" . $row['fName'] . ' ' . $row['lName'] ."</td>
        <td data-title='Email'>" . $row['email'] . "</td>
        <td data-title='Date of Birth'>" . $row['DOB'] . "</td>
        <td data-title='Employer'>" . $row['placeEmployed'] . "</td>
        <td data-title='Address'>" . $row['streetAddress'] . ' ' . $row['city'] . ' ' . $row['zip'] ."</td>
        <td data-title='Edit'>
        <a href='edituser.php'>Edit</a>
        </td>
        </tr>
        ";
            $i++;
        }
        ?>

        <?php
        //Step 4
        mysqli_close($db);
        ?>
    </table>
</div>