<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../login/login.php');
}

$conn = mysqli_connect ('localhost', 'root', '', 'college') or die(mysqli_error());


if(isset($_POST['Delete']))
{
    $delete = $_POST['delete_id'];

   $seperate_notification = implode(",",$delete);

    $query = "DELETE FROM `circular` WHERE id IN($seperate_notification)";
    $run = mysqli_query($conn, $query);


    if($run)
{ 
    echo '<script> ;
    window.location = "Sentnotification.php";
    </script>';
}
else{

    echo '<script> alert("Notifications not deleted");
    window.location = "Sentnotification.php";
    </script>';
    
}

}

?>