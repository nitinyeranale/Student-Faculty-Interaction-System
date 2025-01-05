<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../login/login.php');
}
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Hello, world!</title>

    <style>

.container{
     margin-top:50px;
    border: 3px outset black;
   background-color:white;     
  text-align: center;

}
button{
   
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
  
        <form action="notes.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <p class="h1" style="color:#0067ff ; background-color:#ffe007 ; margin-top:48px; margin-bottom:30px" >Upload Notes Here</p>
            </div>
            <label for="class" style="color:blue;border:black; margin-right:10px"><h5>Choose A Department:</h5></label>
            <select name=department style="color:black">
                <option value="MCA" selected>MCA</option>
                <option value="MECH">MECH</option>
                <option value="ENTC">ENTC</option>
                <option value="CSE">CSE</option>
                <option value="CIVIL">CIVIL</option>
                <option value="ELECTRICAL">ELECTRICAL</option>
            </select> &nbsp &nbsp
            <label for="class" style="color:blue"><h5>Choose A Class:</h5></label>
            <select name=class style="color:black">
                <option value="SY" selected>SY</option>
                <option value="TY">TY</option>
                <option value="FY">FY</option>
            </select><br><br>
            <label for="class" style="color:blue"><h5>Subject Name:</h5></label>
            <input type="text" name='subject'  required>
            <br><br>
            <div class="mb-3" style="color:blue" >
            <br>
            <label for="exampleFormControlInput1" class="form-label" style=" color:blue"><h5>Select file</h5></label>
                <p><span style="color:black;" >Note: File size should be less than 5 MB</span></p> 
                <input type="file" class="form-control" name="pdf1" id="pdf1" style="margin-top:20px" required>
            </div>
            <input class="btn btn-primary" type="submit" value="Upload" name="submit">
            <button style=" background-color:#0d6efd; margin-left:15px" onclick="window.location.href='profile1.php'">Dashboard</button> 
                        

        </form>
    
    </center>

    
    </body>
</html>

<?php

    if(isset($_POST['submit']))
    {  

        $class = $_POST['class'];

        $dept = $_POST['department'];

        $subject=$_POST['subject'];

        $type = $class."-".$dept;


            $conn = mysqli_connect ('localhost', 'root', '', 'college') or die(mysqli_error());

            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $femail=$arr[0];
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


            $allow_ext = array('png','jpg','jepg','pdf','zip');
            $pdfname = $_FILES['pdf1']['name'];//storing file name
            $temp_pdf_name = $_FILES['pdf1']['tmp_name'];//temp name store



            $file_ext = pathinfo($pdfname, PATHINFO_EXTENSION);

            if(!in_array($file_ext, $allow_ext))
            {
                echo '<script> alert("only png , jpg , jepg , pdf , zip files are allowed");
                window.location = "notes.php";
                </script>';
            }

            else if ($_FILES["pdf1"]["size"] > 5000000) 
            {
                echo '<script> alert("Sorry, your file size is too large!!! file size should be less than 5 MB");
                window.location = "notes.php";
                </script>';

              }

             
            else if(file_exists("../student/notes/".$_FILES['pdf1']['name']))
            {
                $pdfname = $_FILES['pdf1']['name'];
                echo '<script> alert("This file is already exists!!! Change the file name and try again");
                window.location = "notes.php";
                </script>';
            }

            else
            {

            $sql = "INSERT INTO notes(`pdf`,`type`,`subject`,`sentby`) VALUES ('$pdfname','$type','$subject','$facultyid')";
            $run = mysqli_query($conn, $sql);
            if($run)
              {
                move_uploaded_file( $temp_pdf_name, "../student/notes/$pdfname");

                   echo '<script> alert("File uploaded successfully");
                         window.location = "notes.php";
                         </script>';


                   $conn->close();
            }
        }

        
    }

?>
<center>
    <button style=" background-color:Green;
 margin-top:20px;" onclick="window.location.href='notesdetails.php'">View Uploaded Syllabus</button>
</center>