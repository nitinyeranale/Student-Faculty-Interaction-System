<?php
    session_start();  
    if(!isset($_SESSION["username"]))
    {
      header('Location:../../login/login.php');
    }
    else
    {
      $value=$_SESSION["username"];
      $pieces=explode(" ",$value);
      $flag=$pieces[1];
      if($flag!='s')
      {
        header('Location:../../login/login.php');
      }
    }
    $value=$_SESSION["username"];
    $pieces=explode(" ",$value);
    $val1=$pieces[0];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>homepage</title>
    <style>
        .home_student{
            background-image:url("img/homepage.jpg");
            height: calc(100vh);
            background-repeat: no-repeat;
            background-size: cover;
        }
        

    </style>
</head>
<body>
<div class="homepage_navbar">
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../../../images/sgulogo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./profile.php?id=<?php echo $val1?>">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../friend/home.php">Friends</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../chat/chatStudent/users.php">Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../home.php">Academics</a>
        </li>
        
      </ul>
      <form class="d-flex">
      <a class="nav-link" href="./logout.php">Logout</a>
      </form>
    </div>
  </div>
</nav>
</div>
<div class="row" style="margin-top: 4%;">
        <div class="col-lg-4" style="border: solid 1px;height: 38rem;position:fixed">
            <div style="border: solid 1px;height: 19rem;"> 
            <center><h4 style="background: #83c2ff;padding: 4px 0 7px 0px;" class="homeh4">Profile</h4></center>
            <?php
                $conn=new mysqli('localhost','root','','college');
                if($conn->connect_error)
                {
                    die("Error in db connection".$conn->connect_error);
                }
                $sql = "select * from `student` where `prn` = '$val1'; ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        
                        $profilepic=$row['profilepic'];
                        $name=$row['fname'].' '.$row['mname'].' '.$row['lname'];
                        // $quote=$row['quote'];
                    }
                }
                $conn->close();
            ?>
            <div style="border: solid 1px;
            width: 32%;
            height: 132px;
            border-radius: 50%;
            margin-left: 35%;
            margin-top: 6%;
            overflow: hidden;">
                
                <img src="../../../images/profilepics/<?php echo $profilepic;?>" style="display: inline-block;
                width: 100%;
                height: 100%;"alt="User-Profile-Image">
            </div>
            <center><h3 style="margin-top: 5%;"><a style="color: black;text-decoration: none;" href="./profile.php"><?php echo $name?></a></h3></center>

            </div>
            <!-- <div style="border: solid 1px;height: 19rem;background: white;">
                <h4 style="margin-left: 2%;
                            margin-top: 10%;
                            color: #f5ae2d;;
                "><?php echo $quote?></h4>
            </div> -->
        </div>
        <div class="col-lg-8" style="border: solid 1px;height: 38rem;">
        <div class="container-fluid my_container  text-center text-white " style="background-attachment: fixed; margin-left: 50%; background-image:url('../../../images/p6.jpg');
            height: calc(97vh);
            background-repeat: no-repeat;
            background-size: cover;">
              <h1 style="padding-top: 24%;font-size: 12vh;" class="name ">Welcome</h1>
              <h3 style="font-size: 223%; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"><?php echo $name?></h3>
          </div>
        
        </div>
        

      </div>

    
</body>
</html>