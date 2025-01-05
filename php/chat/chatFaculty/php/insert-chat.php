<?php 
    session_start();
    if(isset($_SESSION['username']))
    {
        include_once "config.php";
            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $femail=$arr[0];
            $conn=new mysqli('localhost','root','','college');
            if($conn->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
            $query = "select * from `faculty` where `email` = '$femail'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $facultyid=$row['facultyid'];
                }
            }
        $sprn=$facultyid;

        $outgoing_id = $sprn;
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message))
        {
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ('$incoming_id','$outgoing_id','$message')") or die();
        }
    }
    else
    {
         header("location: ../../login/login.php");
    }


    
?>