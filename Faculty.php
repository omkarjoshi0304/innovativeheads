<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
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
    <link rel="stylesheet" href="./css/faculty.css">
</head>

<body>
    <div class="container">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        }
        ?>
        <aside>
            <div class="logo" id="logo" style="margin-top: 1.5rem;display:flex;">
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <h2 style="margin-left: 1rem;margin-top:0.5rem;"><?php echo $row['fname'] ?></h2>
            </div>
            <small style="display:flex;justify-content:center;bottom:12px;position:relative;right:18px">Faculty</small>

            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
            <div class="sidebar">
                <a href="./Student.php" class="active">
                    <span class="material-icons-sharp">grid_view </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="./attenrecord.php">
                    <span class="material-icons-sharp"> people</span>
                    <h3>Attendance Record</h3>
                </a>
                
                <a href="./Leaveapp.php">
                    <span class="material-icons-sharp">contact_mail</span>
                    <h3>Leave Application</h3>
                </a>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">
                    <span class="material-icons-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <main>
            <h1>Dashboard</h1>
            <div class="insights">
                <div class="attendance">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Attendance</h3>
                            <h1>25/30</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>90%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-mute">Last month</small>
                </div>
                <div class="Staff">
                    <span class="material-icons-sharp">groups</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Staff</h3>
                            <h1>2530</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>95%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-mute">Last month</small>
                </div>
                <div class="Leaves">
                    <span class="material-icons-sharp">groups</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Leaves Taken</h3>
                            <h1>1265</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>50%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-mute">This Year</small>
                </div>
            </div>
            <div class="staff-attendance">
                <h2>Staff Attendance</h2>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Last Announcement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql1 = "SELECT * FROM announcement ORDER BY ctn DESC LIMIT 3";
                        $result = mysqli_query($conn, $sql1);
                        if(mysqli_num_rows($result) > 0){
                            while ($row1 = mysqli_fetch_assoc($result) ) {
                                echo "<tr>";
                                echo "<td style='font-weight:bold;text-transform: capitalize;'>" . $row1["fname"] . "</td>";
                                echo "<td>" . $row1["msga"] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </main>
        <div class="right">
            <div class="top">
                <a href="./announce.php" class="active">
                    <span class="material-icons-sharp" id="notify" style="margin-top:0.5rem">
                        campaign
                    </span></a>
                <h2 style="padding-top: 0.5rem;"><?php echo $row['fname'].''.$row['lname'] ?></h2>
                <div class="logo">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>