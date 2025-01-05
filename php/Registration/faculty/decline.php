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
        $sql = "select * from `faculty` where `facultyid` = '$prn'; ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            { 
                $sql="UPDATE `faculty` SET `status`='declined' WHERE `facultyid` = '$prn'";
                $res=$conn->query($sql);
            }
            if($res)
            {
                $conn -> close();
                echo "<script>
                window.location.href='approvedecline.php';  
                </script>";   
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