<?php

    $id=$_GET['id'];
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header('Location:../login/login.php');
    }

    if(isset($_POST['submit']))
    {  
        
            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $sprn=$arr[0];
            $connection = mysqli_connect("localhost","root","","college");
            if($connection->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
            $query = "select * from `student` where `prn` = '$sprn'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $prn=$row['prn'];
                    $class=$row['class'];
                    $department=$row['department'];
                }
                $nclass=$class.'-'.$department;
            }
        

            $allow_ext = array('png','jpg','jepg','pdf','zip');
        
            $pdfname = $_FILES['pdf1']['name'];//storing file name
            $temp_pdf_name = $_FILES['pdf1']['tmp_name'];//temp name store



            $file_ext = pathinfo($pdfname, PATHINFO_EXTENSION);

            if(!in_array($file_ext, $allow_ext))
            {
                echo '<script> alert("only png , jpg , jepg , pdf , zip files are allowed");
                window.location = "home.php";
                </script>';
            }

            else if ($_FILES["pdf1"]["size"] > 5000000) 
            {
                echo '<script> alert("Sorry, your file size is too large!!! file size should be less than 5 MB");
                window.location = "home.php";
                </script>';

            }

            else if(file_exists("../faculty/submissions/".$_FILES['pdf1']['name']))
            {
                $pdfname = $_FILES['pdf1']['name'];
                echo '<script> alert("This file is already exists!!! Change the file name and try again");
                window.location = "home.php";
                </script>';
            }

            else
            {

            $sql = "INSERT INTO `assignmentssubmitted`(`id`, `prn`, `filename`, `submittedAt`, `class`) 
            VALUES('$id','$prn','$pdfname',CURRENT_TIMESTAMP,'$nclass')";
            $run = mysqli_query($connection, $sql);
            if($run)
            {
                move_uploaded_file( $temp_pdf_name, "../faculty/submissions/$pdfname");
                
                echo '<script> alert("File uploaded successfully");
                        window.location = "home.php";
                        </script>';

            }
            else
            {
                $connection->close();
                echo '<script> alert("Unknown error Occured!!!");
                window.location = "home.php";
                </script>';
            }
        }

        
    }



?>