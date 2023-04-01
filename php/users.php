<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];

    $sqlmain = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sqlmain) > 0){
              $row = mysqli_fetch_assoc($sqlmain);
            }
    if($row['role'] == "Student"){
        $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $sql1 = "SELECT * FROM users WHERE role = 'Faculty'";
    $query = mysqli_query($conn, $sql1);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
    }
    else if($row['role'] =="Faculty"){
        $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    $sql1 = "SELECT * FROM users WHERE role = 'Faculty'";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;

    }
?>