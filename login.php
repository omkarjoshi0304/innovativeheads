<?php 
  session_start();
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
      <div class="form login">
      <form action="#" method="POST"  enctype="multipart/form-data" autocomplete="off">
      <img src="img/avatar.svg">
      <h2 class="title">Login</h2>
        <div class="error-text"></div>
        
        <div class="field input">
          <label  class="text">Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label class="text">Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field input">
          <label class="text">Choose the Role</label>
          <select class="select1" id="select1" name="select1"  onfocus="give()" onchange="give()" required>
            <option  value="Student">Student</option>
            <option value="Faculty">Faculty</option>
            </div>
          </select>
        
        <div class="field button">
          <input type="submit" name="submit"  value="Login">
        </div>
        
      </form>
      <div style="text-align:center;"><a href="index.php">Not yet signed up?</a></div>
    </section>
  </div>
</div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
