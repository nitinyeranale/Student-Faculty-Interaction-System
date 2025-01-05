
<?php
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header('Location:../../login/login.php');
    }

    $combine=$_SESSION["username"];
    $arr=explode(" ",$combine);
    $sprn=$arr[0];

    $targetprn=$_GET['id'];
    $connection = mysqli_connect("localhost","root","","college");
    if($connection->connect_error)
    {
        die("Error in db connection".$conn->connect_error);
    }
    $query = "INSERT INTO requests(`user`,`friendid`,`status`) values('$sprn','$targetprn','pending')";
    $result = $connection->query($query);
    if($result)
    {
        echo "<script>window.location.href='./home.php';</script>";
    }
    else
    {
        echo "<script>
        alert('Unknown error occurred!!');
        window.location.href='./home.php';</script>";
    }


?>