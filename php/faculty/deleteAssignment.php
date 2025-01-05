<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../login/login.php');
}

$id=$_GET['id'];

$connection = mysqli_connect("localhost","root","","college");
if($connection->connect_error)
{
    die("Error in db connection".$connection->connect_error);
}
$query = "select * from `assignmentsgiven` where id=$id";
$result = $connection->query($query);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $filename=$row['name'];
    }
}
else
{
    echo "<script>
    alert('Assignment not deleted!!!');
    window.location.href='./details.php';
    </script>";
}

$query = "DELETE from assignmentsgiven where id=$id";
$result = $connection->query($query);
if($result)
{
    $connection->close();
    unlink("../student/assignment/".$filename);
    header('Location:./details.php');
}
else
{
    echo "<script>
    alert('Assignment not deleted!!!');
    window.location.href='./details.php';
    </script>";
}

?>