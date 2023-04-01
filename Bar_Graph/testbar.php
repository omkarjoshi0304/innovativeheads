<?php 
  session_start();
//   include_once "php/config.php";
  include 'SubjectP.php';
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
    <title>Analytics</title>
    <!--Material Icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="./css/bar.css">
</head>
<body>
    <div class="container">
      <?php 
            $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql1) > 0){
              $row = mysqli_fetch_assoc($sql1);
            }
          ?>
        <aside>
            <div class="logo" id="logo" style="margin-top: 1.5rem;display:flex;">
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <h2 style="margin-left: 1rem;margin-top:0.5rem;"><?php echo $row['fname']?></h2>
            </div>
            <small style="display:flex;justify-content:center;bottom:12px;position:relative;right:15px">Student</small>

            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
            </div>
            <div class="sidebar">
                <a href="./Student.php" class="active">
                <span class="material-icons-sharp">grid_view </span>
                <h3>Dashboard</h3>
            </a> 
            <a href="#">
                <span class="material-icons-sharp"> people</span>
                <h3>Attendance Record</h3>
            </a>
            <a href="./Bar_Graph/testbar.php">
                <span class="material-icons-sharp">bar_chart</span>
                <h3>Analytics</h3>
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
           <div class="container">
  <div class="chart">
  <canvas id="barChart" width="600" height="400"></canvas>
    <?php
    // Data for the pie chart


    $data = array(
        "Maths" => $maths,
        "Physics" => $Physics,
        "Chemistry" => $Chemistry,
        "BEE" => $Bee,
        "EMA" => $Ema,
        " " => 100,
    );
    ?>
     </div>
</div> 
    <div id="chat-container">
        <div id="chat-box">
           <div id="typing-indicator"></div> 
          <div id="chat-message"></div>
        </div>
      </div>
            </div>
        </main>
        <div class="right">
            <div class="top">
            <a href="./alert.php" class="active">
                <span  id="notify" class="material-icons-sharp" style="margin-top:0.5rem">
                    notifications
                    </span></a>
                    <h2  style="padding-top: 0.5rem;"><?php echo $row['fname'] .''. $row['lname'] ?></h2>
                    <div class="logo">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['maths', 'physics', 'chemistry','bee','ema','' ],
                datasets: [{
                    label: 'Percentage (%)',
                    data: <?php echo json_encode(array_values($data)); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 255, 255, 0)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 255, 255, 0)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 100,
                            callback: function(value, index, values) {
                                return value + '%';
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Percentage'
                        }
                    }]
                }
            }
        });
    </script>
      <script>
    const messages = ["Hello Welcome to Smart Attendance System."];
const attendance =47; // Change this value to test different attendance percentages

const chatBox = document.getElementById("chat-message");
const typingIndicator = document.getElementById("typing-indicator");

function displayMessage(message) {
  const chars = message.split("");
  let i = 0;
  const intervalId = setInterval(() => {
    chatBox.innerHTML += chars[i];
    i++;
    if (i === chars.length) {
      clearInterval(intervalId);
      chatBox.innerHTML += "<br>";
      typingIndicator.style.display = "none";
    }
  }, 50);
}

function simulateTyping() {
  typingIndicator.style.display = "block";
  if (attendance < 75) {
    displayMessage("Your attendance is below average.");
  } else {
    displayMessage("You should bunk the lectures.");
  }
}

simulateTyping();
        
        </script>
</body>
</html>
