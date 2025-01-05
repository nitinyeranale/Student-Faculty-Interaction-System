MCA<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Timetable</title>

    <style>
        .container {
            margin-top: 48px;
            border: 3px outset black;
            background-color: white;
            text-align: center;

        }

        button {
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
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;



        }
    </style>
</head>

<body>


    <center>
        <div class="container">

            <form action="timetable.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <p class="h1"
                        style="color:#ffe000 ; background-color:#423836 ; margin-top:48px; margin-bottom:30px">Upload
                        Timetable Here</p>
                </div>
                <label  style="color:blue"><h5>Choose a Department:</h5></label>
                <select name="department" style="color:black">
                    <option value="MCA" selected>MCA</option>
                    <option value="MECH">MECH</option>
                    <option value="ENTC">ENTC</option>
                    <option value="CSE">CSE</option>
                    <option value="CIVIL">CIVIL</option>
                    <option value="ELECTRICAL">ELECTRICAL</option>
                </select>&nbsp &nbsp
                <label style="color:blue"><h5>Choose a class:</h5></label>
                <select name="class" style="color:black">
                    <option value="SY" selected>SY</option>
                    <option value="TY">TY</option>
                    <option value="FY">FY</option>
                </select>&nbsp &nbsp

                <label style="color:blue"><h5>Choose a Division:</h5></label>
                <select name="div" style="color:black">
                    <option value="A" selected>A</option>
                    <option value="B">B</option>
                </select><br><br>
                <div class="mb-3" style="color:blue">
                    <label for="exampleFormControlInput1" class="form-label">
                        <h5>Select the file</h5>
                    </label>
                    <p style="color:black">Note: File size should be less than 5 MB</p>
                    <input type="file" style="color:black" class="form-control" name="FileToUpload" id="FileToUpload"
                        required>
                </div>

                <input class="btn btn-primary" type="submit" value="Upload" name="submit">
                <button style=" background-color:#0d6efd; margin-left:15px"
                    onclick="window.location.href='profile1.php'">Dashboard</button>

            </form>
        </div>
    </center>


</body>

</html>

<?php

    if (isset($_POST['submit'])) {
        $class = $_POST['class'];

        $dept = $_POST['department'];

        $division = $_POST['div'];

        $type = $class."-".$dept;

        $conn = mysqli_connect('localhost', 'root', '', 'college') or die(mysqli_error());



        $allow_ext = array('zip','png','jpg','jepg','pdf');
           
        $filename = $_FILES['FileToUpload']['name'];//storing file name
            $temp_file_name = $_FILES['FileToUpload']['tmp_name'];//temp name store



            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($file_ext, $allow_ext)) {
            echo '<script> alert("only png , jpg , jepg , pdf , zip files are allowed");
                window.location = "timetable.php";
                </script>';
        } elseif ($_FILES["FileToUpload"]["size"] > 5000000) {
            echo '<script> alert("Sorry, your file size is too large!!! file size should be less than 5 MB");
                window.location = "timetable.php";
                </script>';
        } elseif (file_exists("../student/timetable/".$_FILES['FileToUpload']['name'])) {
            $filename = $_FILES['FileToUpload']['name'];
            echo '<script> alert("This file is already exists!!! Change the file name and try again");
                window.location = "timetable.php";
                </script>';
        } else {
            $sql = "INSERT INTO timetable(`pdf`,`type`,`division`) VALUES ('$filename','$type','$division')";
            $run = mysqli_query($conn, $sql);
            if ($run) {
                move_uploaded_file($temp_file_name, "../student/timetable/$filename");

                echo '<script> alert("File uploaded successfully");
                window.location = "timetable.php";
                </script>';
            }
        }
    }

?>
<center>
    <button style=" background-color:Green;
 margin-top:20px;" onclick="window.location.href='timetabledetails.php'">View Uploaded Timetable</button>
</center>