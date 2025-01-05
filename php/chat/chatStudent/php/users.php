<?php
    session_start();
    include_once "config.php";
    $combine=$_SESSION["username"];
    $arr=explode(" ",$combine);
    $sprn=$arr[0];

    $outgoing_id = $sprn;
    $sql = "SELECT * from chatusers where prn in(select friendid from requests where user='{$outgoing_id}' and status='accepted')";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
         include_once "data.php";
    }
    echo $output;
?>