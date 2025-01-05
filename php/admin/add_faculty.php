<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header('Location:../login/login.php');
}
else
{
    $fname=$_POST["fname"];
    $mname=$_POST["mname"];
    $lname=$_POST["lname"];
    $department=$_POST["department"];
    $designation=$_POST["designation"];
    $address=$_POST["address"];
    $email=$_POST["email"];
    $mobileno=$_POST["mbno"];
    $password=$_POST["email"];

    $conn=new mysqli('localhost','root','','college');
    if($conn->connect_error)
    {
        die("Error in db connection".$conn->connect_error);
    }
    else
    {
        $sql="INSERT INTO faculty(`fname`, `mname`, `lname`, `department`, `designation`, `email`, `mb`, `address`, `password`,`status`) VALUES('$fname','$mname','$lname','$department','$designation','$email','$mobileno','$address','$password','approved')";
        $result=$conn->query($sql);
        if($result)
        {
            $query = "select * from `faculty` where `email` = '$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $facultyid=$row['facultyid'];
                }
            }
            $sql="INSERT INTO chatusers (`prn`,`fname`,`lname`)VALUES('$facultyid','$fname','$lname')";
            $result=$conn->query($sql);
            echo '<script>alert("Faculty Added!!");
            window.location.href="home.php";
            </script>';     
        }
        $conn->commit();
        $conn->close();
    }

}



    
?>