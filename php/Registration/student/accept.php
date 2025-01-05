<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "college";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
        $prn = $_GET['id'];
        $sql = "select * from `student` where `prn` = '$prn'; ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $password=$row['prn']; 
                $email=$row['email']; 
                $sql="UPDATE `student` SET `status`='approved',`password`='$password' WHERE `prn` = '$prn'";
                $res=$conn->query($sql);
            }
            if($res)
            {
                $conn -> close();
                header('Location:email.php?id='.$email." "."stu");  
            }
            else
            {
                $conn -> close();
                echo "<script>alert('Unknown Error Occurred!!!');
                window.location.href='approvedecline.php';  
                </script>";
            }

        }
?>

