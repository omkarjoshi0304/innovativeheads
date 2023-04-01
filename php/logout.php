<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
            $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if (mysqli_num_rows($sql1) > 0) {
                $row = mysqli_fetch_assoc($sql1);
                }
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            if($row['role'] == "Student"){
                header("location: ../Student.php");
            }
            else if($row['role'] =="Faculty"){
                header("location: ../Faculty.php");
            }
            
            // header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
