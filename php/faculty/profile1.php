<?php
    session_start();
            if(!isset($_SESSION["username"]))
            {
                header('Location:../login/login.php');
            }
            else
            {
                $value=$_SESSION["username"];
                $pieces=explode(" ",$value);
                $flag=$pieces[1];
                if($flag!='f')
                {
                    header('Location:../login/login.php');
                }
            }
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
                    $profilepic=$row['profile_pic'];
                    $name=$row['fname'].' '.$row['lname'];
                }
            }
            $conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Faculty Home</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

    <style>
        .main-container {
            background: url("../../images/dt.jpg") no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            transition: all .5s;
        }
    </style>
</head>

<body>

    <!--wrapper start-->
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">Welcome To <span>SGU</span></div>
                <div style="margin-left: 25%;" class="sidebar-btn">
                    <i class="fas fa-bars"></i>
                </div>
                <ul>
                    <li><a href="friend/home.php"><i class="far fa-comment-alt"></i></a></li>
                    <!-- <li><a href="#"><i class="fas fa-bell"></i></a></li> -->
                    <li><a href="./facultylogout.php"><i class="fas fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>
        <!--header menu end-->
        <!--sidebar start-->
        <div class="sidebar">
            <div class="sidebar-menu">
                <center class="profile">
                    <img src="../../images/profilepics/<?php echo $profilepic?>" alt="">
                    <p><?php echo $name;?></p>
                </center>
               
                <li class="item" id="profile">
                    <a href="facultyprofile.php?id=<?php echo $facultyid;?>" class="menu-btn">
                        <i class="fas fa-user-circle"></i><span>Profile </span>
                    </a>

                </li>
                <li class="item" id="notes">
                    <a href="notes.php" class="menu-btn">
                        <i class="fas fa-book-open"></i><span>Upload Notes</span>
                    </a>
                </li>
                <li class="item" id="syllabus">
                    <a href="syllabus.php" class="menu-btn">
                        <i class="fas fa-book"></i><span>Upload Syllabus</span>
                    </a>
                </li>
                <li class="item" id="Timetable">
                    <a href="timetable.php" class="menu-btn">
                        <i class="fas fa-calendar-alt"></i><span>Upload Timetable</span>
                    </a>
                </li>
                <li class="item" id="notification">
                    <a href="notification.php" class="menu-btn">
                        <i class="far fa-envelope"></i><span>Send Notification</span>
                    </a>
                </li>
                </li>
                <li class="item" id="Assignment">
                    <a href="Assignment.php" class="menu-btn">
                        <i class="far fa-clipboard"></i><span>Assignment</span>
                    </a>
                </li>
                </li>
                <li class="item" id="sentnotification">
                    <a href="Sentnotification.php" class="menu-btn">
                        <i class="fas fa-bell"></i><span>Notification Details</span>
                    </a>
                </li>
               
                <li class="item" id="messages">
                    <a href="" class="menu-btn">
                        <!-- <i class="far fa-comment-alt"></i><span>Messages </span> -->
                    </a>
                    
                </li>
                
                   
            </div>
            </li>
            <!-- <li class="item">
                <a href="#" class="menu-btn">
                    <i class="fas fa-info-circle"></i><span>About</span>
                </a>
            </li> -->
        </div>
    </div>
    <!--sidebar end-->
    <!--main container start-->
    <div class="main-container">
        
    </div>
    <!--main container end-->
    </div>
    <!--wrapper end-->

    <script type="text/javascript">
        $(document).ready(function () {
            $(".sidebar-btn").click(function () {
                $(".wrapper").toggleClass("collapse");
            });
        });
    </script>

</body>

</html>