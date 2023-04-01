<?php 
  session_start();
  include_once "php/config.php";
  if(isset($_SESSION['unique_id'])){
    
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <img class="wave" src="img/wave.png">
  <div class="container">
    <div class="img">
			<img src="img/Lovepik_com-611649078-Tech vector illustration face recognition 25D illustration.png">
		</div>
    <section class="login-content">
    <section class="form signup">
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <img src="img/avatar.svg">
        <h2>Registration</h2>
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label class="text">First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label class="text">Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label class="text">Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label class="text">Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label class="text">Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field input">
          <label class="text">Choose the Role</label>
          <select class="select1" id="select1" onfocus="give()" onchange="give()" name="select1" required>
            <option value="Student" >Student</option>
            <option value="Faculty" >Faculty</option>
          </select>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
