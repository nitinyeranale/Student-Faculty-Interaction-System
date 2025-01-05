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
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="assignmentTable.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
    #myTable td 
    {
            text-align: left;
            padding: 12px;
    }
    #myTable
    {
        width: 100%;
        font-size: 18px;
        border-radius: 16px;
        border:none;
        opacity: 85%;
    }
    input#myInput:focus 
    {
        outline: none;
    }
    </style>
</head>
<body style="height:100%;background-size:cover;background-image:url(../../images/13.jpg);background-attachment: fixed;">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
            <div style="padding-left: 1%;" class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav items ">
                        <a class="nav-link new" style="padding-left: 7%;" href="./home.php">Assignment</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./notes.php">Notes</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./syllabus.php">Syllabus</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./timetable.php">Timetable</a>
                        <a class="nav-link active" style="padding-left: 7%;" href="./notification.php">Notifications</a>
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
            $qr = "select * from `student` where `prn` = '$sprn'";
            $result = $connection->query($qr);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $department=$row['department'];
                    $class=$row['class'];
                    $division=$row['division'];
                }
                $cmbn=$class.'-'.$department.'-'.$division;
            }

            $query="SELECT * from circular where `type`='$cmbn' and read_status=0 ORDER BY `time` DESC";
            $query_run = mysqli_query($connection, $query);
            ?>
                <div style="width: 94%;margin-left: 3%;margin-top: 2%;">
                <input style="margin-top: 5%;margin-bottom:0%;border-radius: 11px;" type="text" id="myInput" placeholder="Search...">
                    <table id="myTable" style="background: white;"> 
                        <?php
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row =mysqli_fetch_array($query_run))
                                {
                                    $sentbyid=$row['sentby'];
                                    $que = "select * from `faculty` where `facultyid` =$sentbyid";
                                    $res = $connection->query($que);
                                    if ($res->num_rows > 0) 
                                    {
                                        while($rows = $res->fetch_assoc()) 
                                        {
                                            $name=$rows['fname'].' '.$rows['lname'];
                                        }
                                    }
                    ?>
                        <tr>
                            <td>
                                <strong><?php echo 'From: '.$name ?></strong><br>
                                <strong><p style="font-size: 17px;"><?php echo $row['time']?></p></strong>
                                <strong><?php echo $row['notification'] ?></strong>
                            </td>
                            <td>
                                <p style="background: darkorchid;
                                    color: white;
                                    padding-left: 12px;
                                    width: 59px;
                                    border-radius: 20px;
                                    padding-bottom: 1px;
                                    margin-right: -33px;
                                    margin-top: 11%;">new
                                </p>
                            </td>
                        </tr>
                <?php
                        }
                }
                $query2="SELECT * from circular where `type`='$cmbn' and read_status=1 ORDER BY `time` DESC";
                $query_run2 = mysqli_query($connection, $query2);
            ?>
                <div style="width: 94%;margin-left: 3%;margin-top: 2%;">
                    <table id="myTable" style="background: white;"> 
                        <?php
                        if(mysqli_num_rows($query_run2)>0)
                            {
                                while($row =mysqli_fetch_array($query_run2))
                                {
                                    $sentbyid2=$row['sentby'];
                                    $que2 = "select * from `faculty` where `facultyid` =$sentbyid2";
                                    $res2 = $connection->query($que2);
                                    if ($res2->num_rows > 0) 
                                    {
                                        while($rows2 = $res2->fetch_assoc()) 
                                        {
                                            $name2=$rows2['fname'].' '.$rows2['lname'];
                                        }
                                    }
                    ?>
                        <tr>
                            <td>
                            <strong><?php echo 'From: '.$name2?></strong><br>
                            <p style="font-size: 17px;"><?php echo $row['time'] ?></p>
                            <?php echo $row['notification'] ?>
                            </td>
                        </tr>
                <?php
                        }
                }
                $query3="UPDATE circular SET read_status=1 WHERE read_status=0";
                $query_run3 = mysqli_query($connection, $query3);
            ?>
            </table>
        </div>
        <script>
        $(document).ready(function()
        {
            $("#myInput").on("keyup", function() 
            {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() 
                {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        </script>

</body>
</html>