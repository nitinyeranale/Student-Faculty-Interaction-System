<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../../login/login.php');
}
$connection = mysqli_connect("localhost","root","","college");
if($connection->connect_error)
{
    die("Error in db connection".$conn->connect_error);
}
$fid=$_GET['id'];

$combine=$_SESSION["username"];
$arr=explode(" ",$combine);
$sprn=$arr[0];

$query = "DELETE from requests WHERE user='$sprn' and friendid='$fid'";
$result = $connection->query($query);
if($result)
{   
    $connection->close();
    header('Location:./sentrequest.php');
}





?>