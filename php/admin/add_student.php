<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header('Location:../login/login.php');
}
else
{
    if(isset($_POST['btnsubmit']))
    {
        $prn=$_POST['prn'];
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $department=$_POST['department'];
        $email=$_POST['email'];
        $class=$_POST['class'];
        $division=$_POST['division'];
        $conn=new mysqli('localhost','root','','college');
        if($conn->connect_error)
        {
            die("Error in db connection".$conn->connect_error);
        }
        else
        {
            $sql="INSERT INTO student (`prn`,`fname`, `mname`, `lname`, `department`,`email`,`status`,`class`,`division`,`password`)VALUES(UPPER('$prn'),'$fname','$mname','$lname','$department','$email','approved','$class','$division',UPPER('$prn'))";
            $result=$conn->query($sql);
            if($result)
            {
                $sql="INSERT INTO chatUsers (`prn`,`fname`,`lname`)VALUES(UPPER('$prn'),'$fname','$lname')";
                $result=$conn->query($sql);
                echo "<script>alert('Student added successfully!!!');
                window.location.href='./home.php';  
                </script>";   
            }
            else
            {
                echo "<script>alert('Unknown error occured.');
                window.location.href='./home.php'; 
                </script>";
            }
            $conn->commit();
            $conn->close();
        }


    }
}

    
?>