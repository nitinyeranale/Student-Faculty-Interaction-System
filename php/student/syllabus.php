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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="assignmentTable.css">
    <style>
        #myTable tr.header {
            background-color: #9fffa2;
        }

        #myTable tr.header:hover {
            background-color: #9fffa2;
        }
        .headT
        {
            border: solid 1px #b9b9b9;
            padding-left: 33%;
            width: 77%;
            margin-left: 11%;
            margin-bottom: 2%;
            padding-top: 2px;
            padding-bottom: 6px;
            background: #b3b6ff;
            margin-top: 4%;
        }
        .btn:hover
        {
            box-shadow: 8px 8px 17px 0px black;
        }
        .badge 
        {
            padding: 4px 7px;
            border-radius: 62%;
            background-color: red;
            display: inline-block;
            text-decoration: none;
            height: 21px;
            margin-top: 4px;
        }

       
    </style>
</head>

<body style="height:calc(100vh);background-image:url(../../images/14.jpg);background-size:contain;background-attachment: fixed;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div style="padding-left: 1%;" class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav items ">
                        <a class="nav-link new " style="padding-left: 7%;" href="./home.php">Assignment</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./notes.php">Notes</a>
                        <a class="nav-link active" style="padding-left: 7%;" href="./syllabus.php">Syllabus</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./timetable.php">Timetable</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./notification.php">Notifications</a>
                        <?php include('badge.php');?>
                    </div>
                    <button style="padding-bottom: 2px;
                            margin-left: 123vh;
                            padding-top: 0px;
                            height: 36px;
                            margin-top: 2px;" 
                        class='btn btn-danger' onclick='window.location.href="home/studenthome.php"'>
                    Dashboard</button>
                </div>
            </div>
        </nav>
        <center>
            <div style="border: solid 1px;
                        height: 35vh;
                        width: 44%;
                        margin-top:11%;
                        background:white;
                        box-shadow: inset 0px 0px 20px 0px;">
                <form action="./syllabusdownload.php" method="post">
                <label for="class"  style="margin-top:30px; color:blue"><h5>Choose A Department : </h5></label>
                    <select name=department style="color:black;">
                        <option value="MCA" selected>MCA</option>
                        <option value="MECH">MECH</option>
                        <option value="ENTC">ENTC</option>
                        <option value="CSE">CSE</option>
                        <option value="CIVIL">CIVIL</option>
                        <option value="ELECTRICAL">ELECTRICAL</option>
                    </select>
                    <br><br>

                    <label for="class" style="color:blue"><h5>Choose A Class : </h5></label>
                    <select name=class style="color:black;">
                        <option value="FY">FY</option>
                        <option value="SY"selected>SY</option>
                        <option value="TY" >TY</option>
                        <option value="Final Year">Final Year</option>
                    </select><br><br>
                    <button class="btn btn-primary" name='download'>Download</button>
                </form>                    
            </div>
        </center>
</body>

</html>