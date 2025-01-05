<?php
    session_start();
    include_once "config.php";
            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $femail=$arr[0];
            $conn=new mysqli('localhost','root','','college');
            if($conn->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
            $query = "select * from `faculty` where `email` = '$femail'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $facultyid=$row['facultyid'];
                }
            }
    $sprn=$facultyid;

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