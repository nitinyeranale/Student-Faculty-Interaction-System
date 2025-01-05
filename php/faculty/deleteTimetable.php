<?php

session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../login/login.php');
}
$conn = mysqli_connect ('localhost', 'root', '', 'college') or die(mysqli_error());


if(isset($_POST['Delete']))
{
 
    $id = $_POST['delete_id'];
    $file_delete = $_POST['delete_file'];

    $query = "DELETE FROM `timetable` WHERE id = '$id'";
    $run = mysqli_query($conn, $query);


    if($run)
{ 
    unlink("../student/timetable/".$file_delete);
    echo '<script> alert("File deleted successfully");
    window.location = "timetabledetails.php";
    </script>';
}
else{
    echo '<script> alert("File not deleted");
    window.location = "timetabledetails.php";
    </script>';

}


}


?>