<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>

    <style>


.container{
     margin-top:48px;
    border: 3px outset black;
  background-color:white;    
  text-align: center;

 
}
button{
    margin-bottom:20px;
    display: inline-block;
    font-weight: 400;
    line-height: 1.5;
    color: #fff;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;

}




    
    
    </style>
</head>

<body>
    

<center>
    <div class="container">
        <form action="Assignment.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <p class="h1" style="color:black ; background-color:#1d96ff ;margin-top:48px; ">Send Assignments Here </p>
            </div>
            <label for="class"  style="margin-top:30px; color:blue"><h5>Choose A Department:</h5></label>
            <select name=department style="color:black;">
                <option value="MCA" selected>MCA</option>
                <option value="MECH">MECH</option>
                <option value="ENTC">ENTC</option>
                <option value="CSE">CSE</option>
                <option value="CIVIL">CIVIL</option>
                <option value="ELECTRICAL">ELECTRICAL</option>
            </select> &nbsp &nbsp

          
            <label for="class" style="color:blue"><h5>Choose A Class:</h5></label>
           <select name=class style="color:black;">
                <option value="SY" selected>SY</option>
                <option value="TY">TY</option>
                <option value="FY">FY</option>
            </select>&nbsp &nbsp
           
            <label for="class" style="color:blue"><h5>Subject Name:</h5></label>
            <input type="text" name=subject  required>
            <br><br>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label" style=" color:blue"><h5>Select file</h5></label>
                <p style="color:black">Note: File size should be less than 5 MB</p>
                <input type="file" class="form-control" name="pdf1" id="pdf1" required>
            </div>

            <input style="  margin-bottom:20px;" class="btn btn-primary" type="submit" value="Upload" name="submit" >          
            <button style=" background-color:#0d6efd;  margin-left:15px;" onclick="window.location.href='profile1.php'">Dashboard</button> 
        </form>

    </div>
    <button style=" background-color:green;
                    margin-top:30px; 
                    font-size:20px;
                    width:30%;" onclick="window.location.href='details.php'">View Given Assignment Submissions</button> 

    </center>


</body>

</html>
<?php

    if(isset($_POST['submit']))
    {  
        $combine=$_SESSION["username"];
        $arr=explode(" ",$combine);
        $semail=$arr[0];
        
        $class = $_POST['class'];

        $dept = $_POST['department'];

        $Sub = $_POST['subject'];

        $type = $class."-".$dept;

        $conn = mysqli_connect ('localhost', 'root', '', 'college') or die(mysqli_error());
        
        $query = "select * from `faculty` where `email` = '$semail'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $facultyid=$row['facultyid'];
            }
        }


            $allow_ext = array('zip','png','jpg','jepg','pdf');
           
            $pdfname = $_FILES['pdf1']['name'];//storing file name
            $temp_pdf_name = $_FILES['pdf1']['tmp_name'];//temp name store



            $file_ext = pathinfo($pdfname, PATHINFO_EXTENSION);

            if(!in_array($file_ext, $allow_ext))
            {
                echo '<script> alert("only png , jpg , jepg , pdf , zip files are allowed");
                window.location = "Assignment.php";
                </script>';
            }

            else if ($_FILES["pdf1"]["size"] > 5000000) 
            {
                echo '<script> alert("Sorry, your file size is too large!!! file size should be less than 5 MB");
                window.location = "Assignment.php";
                </script>';

              }

             
            else if(file_exists("../student/assignment/".$_FILES['pdf1']['name']))
            {
                $pdfname = $_FILES['pdf1']['name'];
                echo '<script> alert("This file is already exists!!! Change the file name and try again");
                window.location = "Assignment.php";
                </script>';
            }

            else
            {

            $sql = "INSERT INTO assignmentsgiven (`name`,`class`,`subject`,`givenAt`,`givenby`) VALUES ('$pdfname','$type','$Sub',CURRENT_TIMESTAMP,'$facultyid')";
            $run = mysqli_query($conn, $sql);
            if($run)
            {
                move_uploaded_file( $temp_pdf_name, "../student/assignment/$pdfname");

                echo '<script> alert("File uploaded successfully");
                window.location = "Assignment.php";
                </script>';
            }
        }


    }





?>