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

    $query = "DELETE FROM `notes` WHERE id = '$id'";
    $run = mysqli_query($conn, $query);


    if($run)
{ 
    unlink("../student/notes/".$file_delete);
    echo '<script> alert("File deleted successfully");
    window.location = "notesdetails.php";
    </script>';
}
else{
    echo " record not deleted ";

}







}





?>