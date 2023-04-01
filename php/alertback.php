<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql1 = "SELECT * FROM announcement";
   
        $query = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    // $output .= '<div class="chat outgoing">
                    //             <div class="details">
                    //                 <p>'. $row['msga'] .'</p>
                    //             </div>
                    //             </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                    
                                <div class="details">
                                    <b style = "text-transform:capitalize;">'. $row['fname'] .'</b>
                                    <div id = "layout">
                                    <p>'. $row['msga'] .'</p>
                                    <b style="float:right;font-size:8px">'. $row['time'] .'</b>
                                    </div>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>
                         