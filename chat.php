<?php 
  session_start();
  include_once "php/config.php";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <!--Stylesheet-->
    <link rel="stylesheet" href="./css/chat.css">
    <!-- <link rel="stylesheet" href="./style.css"> -->
</head>
<body>
    <div class="container">
      <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
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
            <a href="#">
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
            <h1>Leave Application</h1>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql1) > 0){
            $row1 = mysqli_fetch_assoc($sql1);
          }else{
            if($row1['role'] == "Student"){
              header("location: ../Student.php");
          }
          else if($row1['role'] =="Faculty"){
              header("location: ../Faculty.php");
          }
          
          }
        ?>

      </header>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <h2>Title:</h2>
        <input type="text" style="width:40rem;border-radius:3px;" name="title" class="input-field"  autocomplete="off">
        <h2>Description:</h2>
        <textarea type="text" style="height:20rem;width:40rem;border:1px solid grey;padding:0.5rem;" name="message" class="input-field2"></textarea><br><br>
        <center><button>Submit</button></center>
      </form>
     
        <script src="javascript/chat.js"></script>
    </section>
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


</body>
</html>
