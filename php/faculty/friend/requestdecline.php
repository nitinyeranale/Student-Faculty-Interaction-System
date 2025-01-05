<?php
    session_start();
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

    $target=$_GET['id'];
    $query = "DELETE FROM requests where user='$target' and friendid='$id' and status='pending'";
    $result = $connection->query($query);
    if($result)
    {
        $connection->close();
        echo "<script>
        window.location.href='./arrivedrequest.php';</script>";
    }
    else
    {
        $connection->close();
        echo "<script>
        alert('Unknown error occurred!!');
        window.location.href='./arrivedrequest.php';</script>";
    }


?>