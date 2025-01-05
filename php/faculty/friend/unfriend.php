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
$fid=$_GET['id'];


$query = "DELETE from requests WHERE user='$id' and friendid='$fid' and status='accepted'";
$result = $connection->query($query);
if($result)
{   $query = "DELETE from requests WHERE user='$fid' and friendid='$id' and status='accepted'";
    $result = $connection->query($query);
    if($result)
    {
        header('Location:./friends.php');
    }
    else
    {
        $connection->close();
        echo "<script>
        alert('Unknown error occurred');
        window.location.href='./friends.php';
        </script>";
    }
    
}
else
{
    $connection->close();
    echo "<script>
    alert('Unknown error occurred');
    window.location.href='./friends.php';
    </script>";
}

?>
