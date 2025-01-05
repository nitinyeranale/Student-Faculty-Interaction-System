<?php 
    session_start();
    if(isset($_SESSION['username'])){
        include_once "config.php";
        $combine=$_SESSION["username"];
        $arr=explode(" ",$combine);
        $sprn=$arr[0];

        $outgoing_id = $sprn;
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN chatusers ON chatusers.prn = messages.outgoing_msg_id
                WHERE (outgoing_msg_id ='$outgoing_id' AND incoming_msg_id ='$incoming_id')
                OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else
                {
                    $output .= '<div class="chat incoming">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }
        else
        {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
         header("location: ../../login/login.php");
    }

?>