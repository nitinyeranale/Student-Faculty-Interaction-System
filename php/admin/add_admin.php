<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header('Location:../login/login.php');
}
else
{
    if(isset($_POST['btnSubmitAdmin']))
    {
        
        $fname=$_POST["fnameAdmin"];
        $mname=$_POST["mnameAdmin"];
        $lname=$_POST["lnameAdmin"];
        $department=$_POST["departmentAdmin"];
        $designation=$_POST["designationAdmin"];
        $address=$_POST["addressAdmin"];
        $email=$_POST["emailAdmin"];
        $mobileno=$_POST["mbnoAdmin"];
        $password=$_POST["emailAdmin"];


    $conn=new mysqli('localhost','root','','college');
    if($conn->connect_error)
    {
        die("Error in db connection".$conn->connect_error);
    }
    else
    {
        $sql="INSERT INTO admin(`fname`, `mname`, `lname`, `department`, `designation`, `email`, `mobileno`, `address`, `password`) VALUES('$fname','$mname','$lname','$department','$designation','$email','$mobileno','$address','$password')";
        $result=$conn->query($sql);
        if($result)
        {
            echo '<script>alert("New Admin Added!!");
            window.location.href="home.php";
            </script>';     
        }
        $conn->commit();
        $conn->close();
    }
    }
    else
    {
        echo "OFF";
    }
}

?>