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

<body style="background-image:url(../../images/p2-dark.jpg);background-size:cover;background-attachment: fixed;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div style="padding-left: 1%;" class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav items ">
                        <a class="nav-link new active" style="padding-left: 7%;" href="./home.php">Assignment</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./notes.php">Notes</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./syllabus.php">Syllabus</a>
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
        <?php
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
            
            $query="SELECT * from assignmentsgiven where class='$nclass' and id not in(select id from assignmentssubmitted where prn='$prn')";
            $query_run = mysqli_query($connection, $query);
            ?>
                <div style="width: 94%;margin-left: 3%;margin-top: 2%;">
                    <table id="myTable" style="background: white;">
                        <tr class="header">
                            <th>Assignment Name</th>
                            <th>Subject</th>
                            <th>Given At</th>
                            <th>Download</th>
                            <th>Upload</th>
                        </tr>
                        <?php
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row =mysqli_fetch_array($query_run))
                                {
                    ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['subject']?></td>
                            <td><?php echo $row['givenAt'] ?></td>
                            <td>
                                <a href="assignment/<?php echo $row['name'] ?>" download>
                                    <button class="btn btn-primary">Download</button>
                                </a>
                            </td>
                            <td>
                                <form action="upload.php?id=<?php echo $row['id']?>" method="post"
                                    enctype="multipart/form-data">
                                    <input style="width: 46%;" type="file" name="pdf1" id="pdf1" required>
                                    <button name="submit" class="btn btn-danger">Upload</button>
                            </td>
                            </form>
                        </tr>
                <?php
                        }
                }
                else
                {
                    ?>
                <tr>
                    <td colspan="7">No Assignments left!! Hurrayyy!!!!!</td>
                </tr>
                <?php
                $connection->close();
                }
            ?>
            </table>
        </div>

</body>

</html>