<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header('Location:../login/login.php');
}
else
{
    $del=$_GET['id'];
    $connection = mysqli_connect("localhost","root","","college");
    $pieces=explode(" ",$del);
    $value=$pieces[0];
    $flag=$pieces[1];
    if($flag=='student')
    {
        $query="UPDATE student SET `status`='deleted',`password`=NULL WHERE prn='$value'";
        $query_run = mysqli_query($connection, $query);
        if($query_run)
        {
            $connection->close();
            header('Location:./manage_students.php');
        }
        else
        {
            $connection->close();
            echo "<script>alert('Error in deleting!!!!');</script>";
        }
    }
    else if($flag=='faculty')
    {
        $query="UPDATE faculty SET `status`='deleted',`password`=NULL WHERE facultyid='$value'";
        $query_run = mysqli_query($connection, $query);
        if($query_run)
        {
            $connection->close();
            header('Location:./manage_faculty.php');
        }
        else
        {
            $connection->close();
            echo "<script>alert('Error in deleting!!!!');</script>";
        }
    }
}

?>