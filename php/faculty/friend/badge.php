<?php
    if(!isset($_SESSION["username"]))
    {
        header('Location:../../login/login.php');
    }
            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $femail=$arr[0];
            $connection = mysqli_connect("localhost","root","","college");
            if($connection->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
            $query = "select * from `faculty` where `email` = '$femail'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $id=$row['facultyid'];
                }
            }
    $sql = "SELECT count(*) as totalnot from requests where friendid='$id' and status='pending' and read_status=0";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $connection->close();
?>
    <span class="badge"><?php  
        $noti=$row['totalnot'];
        if($noti > 0)
            {
                echo $noti; 
            }
    ?></span>