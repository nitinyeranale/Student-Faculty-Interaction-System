<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../../login/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Requests</title>
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
        .badge 
        {
            padding: 4px 7px;
            border-radius: 62%;
            background-color: red;
            display: inline-block;
            text-decoration: none;
            height: 21px;
            margin-top: 4px;
            padding-right: 8px;
            margin-left: -2px;
        }

    </style>
</head>

<body style="height:calc(100vh);background-image:url(../../images/p5-dark.jpg);background-size:cover;background-attachment: fixed;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div style="padding-left: 1%;" class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav items ">
                        <a class="nav-link new" style="padding-left: 7%;" href="./home.php">Home</a>
                        <a class="nav-link active" style="padding-left: 7%;" href="./sentrequest.php">Sent</a>
                        <a class="nav-link" style="padding-left: 7%;" href="./arrivedrequest.php">Requests</a>
                        <?php include('badge.php');?>
                        <a class="nav-link" style="padding-left: 7%;" href="./friends.php">Friends</a>   
                        <a class="nav-link" style="padding-left: 7%;" href="../../chat/chatFaculty/users.php">Chat</a>
                </div>
                </div>
                <button style="padding-bottom: 2px;
                            margin-left: 143vh;
                            padding-top: 0px;
                            height: 36px;
                            margin-top: 2px;" 
                        class='btn btn-danger' onclick='window.location.href="../profile1.php"'>
                    Dashboard</button>
            </div>
        </nav>
        <?php
            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $femail=$arr[0];
            $connection = mysqli_connect("localhost","root","","college");
            if($connection->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
            $query = "select * from `faculty` where `email` = '$femail'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $id=$row['facultyid'];
                }
            }
            $query = "SELECT * from faculty where facultyid in(select friendid from requests where user='$id' and status='pending')";
            $result = $connection->query($query);
            ?>
                <div style="width: 94%;margin-left: 3%;margin-top: 2%;">
                    <table id="myTable" style="width: 90%;margin-left: 5%;background: white;">
                        <tr class="header">
                            <th>Faculty</th>
                            <th>Name</th>
                            <th>Dept</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row =mysqli_fetch_array($result))
                                {
                                    $facultyid=$row['facultyid'];
                                    $pname=$row['fname'].' '.$row['mname'].' '.$row['lname'];
                                    $pclass=$row['department'];
                    ?>
                        <tr>
                            <td><?php echo $facultyid ?></td>
                            <td><?php echo $pname?></td>
                            <td><?php echo $pclass?></td>
                            <td>
                                <button class="btn btn-success disabled">Request sent</button>
                                <button class="btn btn-danger" onclick="window.location.href='revoke.php?id=<?php echo $facultyid?>'">Revoke</button>

                            </td>
                        </tr>
                <?php
                        }
                }
                else
                {
                    ?>
                <tr>
                    <td colspan="7">No Requests sent</td>
                </tr>
                <?php
                }
            ?>
            </table>

            <?php
                $query = "SELECT * from student where prn in(select friendid from requests where user='$id' and status='pending')";
                $result = $connection->query($query);
            ?>
            <h1 style="margin-left: 5%;
                border: solid 1px;
                text-align: center;
                width: 90%;
                margin-top: 2%;
                padding: 2px 0 8px 0;
                background: black;
                color: white;">Students</h1>
            <table id="myTable" style="width: 90%;margin-left: 5%;background: white;">
                        <thead>
                        <tr class="header">
                                <th>PRN</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
            <?php
                        if(mysqli_num_rows($result)>0)
                            {
                                while($row =mysqli_fetch_array($result))
                                {
                                    $pprn=$row['prn'];
                                    $pname=$row['fname'].' '.$row['mname'].' '.$row['lname'];
                                    $pclass=$row['class'].'-'.$row['department'];
                        ?>
                    <tbody id='myBody'>
                        <tr>
                            <td><?php echo $pprn ?></td>
                            <td><?php echo $pname?></td>
                            <td><?php echo $pclass?></td>
                            <td>
                                <button class="btn btn-success disabled">Request sent</button>
                                <button class="btn btn-danger" onclick="window.location.href='revoke.php?id=<?php echo $pprn?>'">Revoke</button>
                            </td>
                        </tr>
                    </tbody>
                <?php
                        }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="7">No Requests sent</td>
                    </tr>
                <?php
                $connection->close();
                }
            ?>
            </table>

        </div>
</body>

</html>