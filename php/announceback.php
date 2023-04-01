<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql1) > 0) {
            $row = mysqli_fetch_assoc($sql1);
        }
        $name = $row['fname'];
        // $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO announcement (outgoing_msg_id,fname,msga,time)
                                        VALUES ('{$outgoing_id}','{$name}', '{$message}',NOW())") or die();
        }
    }else{
        header("location: ../login.php");
    }
    
?>