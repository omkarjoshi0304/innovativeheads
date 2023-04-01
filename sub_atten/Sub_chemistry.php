<?php 
  session_start();
//   include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--Material Icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="./Sub_attn.css">
</head>


<body>
    <div class="container">
        <aside>
            <div class="sidebar">
            </div>
        </aside>

        <main>



            <div class="insights">
                <div class="attendance">
                    <span class="material-icons-sharp">analytics</span>

                    <?php
                    include 'SubjectP.php';
                    $attendance_percentage = round(($mathsTPC / $mathsTC) * 100);
                    ?>

                    <div class="middle">
                        <div class="left">
                            <h3>Total Attendance</h3>
                            <h1><?php echo $mathsTPC.'/'.$mathsTC; ?></h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36' style="stroke-dashoffset: calc(228 - (228 * <?php echo $attendance_percentage; ?>) / 100);"></circle>
                            </svg>
                            <div class="number">
                                <p><?php echo $attendance_percentage.'%'; ?></p>
                            </div>
                        </div>
                    </div>
                    <small class="text-mute">Till Now</small>
                </div>
            


             <div class="Leaves">

                    <div class="middle">
                        <div class="left">
                        <img src="Chemistry .jpg" class="img" >
                        <!-- add data here -->
                        </div>

                    </div>
                    <!-- <small class="text-mute">This Year</small> -->
            </div>



            <div class="Leaves">
                    <span class="material-icons-sharp">group</span>
                    <div class="middle">
                        <div class="left">
                            <h2>Subject Name: Chemistry</h2>
                            <h4>Faculty: Mrs. Trupti Shah</h4>
                        </div>

                    </div>
                    <small class="text-mute">This Year</small>
            </div>
</div>



<!-- Attendance_record -->
<?php
require('db_connect.php');


$sqltest = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sqltest) > 0) {
            $row = mysqli_fetch_assoc($sqltest);
        }
$name = $row['fname'];

// SQL queries to retrieve the data
$sql1 = "SELECT * FROM maths WHERE name = '$name'";
$sql2 = "SELECT * FROM maths WHERE name = 'Timestamp'";

// Execute the queries
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);

// Check if there are any results
if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0) {
    // Fetch the result sets as arrays
    $dates = mysqli_fetch_array($result1, MYSQLI_NUM);
    $statuses = mysqli_fetch_array($result2, MYSQLI_NUM);
    // Output the arrays in an HTML table format
    
    echo '
            <div class="staff-attendance">
            <h2>Attendance Record</h2>
            <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
            for ($i = 2; $i < count($dates); $i++) {
                if ($dates[$i] == 'absent') {
                    $class = 'warning';
                } elseif ($dates[$i] == 'present') {
                    $class = 'success';
                } else {
                    $class = '';
                }
                echo '<tr> 
                        <td>' . substr($statuses[$i], 0, -5) . '</td>
                        <td class="' . $class . '">' . $dates[$i] . '</td>
                      </tr>';
            }
    
    echo '</tbody>
          </table>
          </div>';
} else {
    echo "No results found.";
}

// Close the connection
mysqli_close($conn);
?>


        </main>
    </div>
</body>
<script type="text/jabvascript" src="Sub_attn.js"></script>
</html>