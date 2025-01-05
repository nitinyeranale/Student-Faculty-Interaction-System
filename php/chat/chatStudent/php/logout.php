<?php
    session_start();
    if(isset($_SESSION['username'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id))
        {
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE chatusers SET chat_status = '{$status}' WHERE prn='{$_GET['logout_id']}'");
            if($sql)
            {
                header("location: ../../../student/home/studenthome.php");
            }
        }else{
             header("location: ../users.php");
        }
    }else{  
        header("location: ../../login/login.php");
    }
?>