<?php 
    session_start();     
    include('connection.php');  
    $username = $_POST['user'];  
    $password = $_POST['pass'];  

        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
    
        $sql = "select * from faculty where email = '$username' and password = '$password' and status='approved'";  
        $result = mysqli_query($con, $sql);  
        $count = mysqli_num_rows($result);   
        if($count == 1)
        {  
            $_SESSION["username"]=$username.' '.'f';
            header("Location:../faculty/profile1.php");  
        }
        else
        {
            $sql = "select * from student where prn = '$username' and password = '$password' and status='approved'";  
            $result = mysqli_query($con, $sql);  
            $count = mysqli_num_rows($result);
            if($count == 1)
            {  
                $_SESSION["username"]=$username.' '.'s';
                header("Location:../student/home/studenthome.php");  
            }
            else
            {
                $sql = "select * from admin where email = '$username' and password = '$password'";  
                $result = mysqli_query($con, $sql);  
                $count = mysqli_num_rows($result);
                if($count == 1)
                {  
                    $_SESSION["username"]=$username.' '.'a';
                    header("Location:../admin/home.php");  
                }
                else
                {
                    echo "<script>alert('Invalid Credential');
                    window.location.href='login.php';
                    
                    </script>";
                    
                }
            }
        }
?>  