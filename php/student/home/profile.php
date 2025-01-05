<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header('Location:../../login/login.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body style="background: #eaeaea;padding-bottom: 2%;">
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid"> 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./studenthome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./updateprofile1.php">Update Profile</a>
        </li>
    </div>
  </div>
</nav>
<div class="col-lg-12">
            <?php
                    $value=$_SESSION["username"];
                    $pieces=explode(" ",$value);
                    $val1=$pieces[0];
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
                        $email=$row['email'];
                        $department=$row['class'].'-'.$row['department'];
                        $mobileNo=$row['mobileno'];
                        $prn=$row['prn'];
                        $currentcity=$row['currentcity'];
                        $highschool=$row['highschool'];
                        $highercollege=$row['highercollege'];
                        $hometown=$row['hometown'];
                        $gender=$row['gender'];
                        $sociallinks=$row['sociallinks'];
                        $address=$row['address'];
                        
                    }
                }
                $conn->close();
            ?>
            <div style="border: solid 1px;
                width: 19%;
                height: 40vh;
                border-radius: 50%;
                margin-left: 39%;
                margin-top: 6%;
                overflow: hidden;">
                    
                    <img src="../../../images/profilepics/<?php echo $profilepic;?>" style="display: inline-block;
                    width: 100%;
                    height: 100%;"alt="User-Profile-Image">
            </div>
</div>
<div class="row" style="margin-top: 2%;">
                <div class="col-lg-12"style="margin-top: 2%;
                          border: solid 1px;
                          margin-left: 7%;
                          width: 86%;
                          padding-left: 3%;
                          border-radius: 21px;box-shadow: 10px 9px 18px #6b6868;background: white;" >
                        <br>
                        <center><h4 style="margin-bottom: 2%;">Primary Information</h4></center>
                          <strong style="padding-right: 111px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Name
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $name ;?></span><br>
                          <br>
                          <strong style="padding-right: 116px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Email
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $email ;?></span><br>
                          <br>
                          <strong style="padding-right: 37px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Department
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $department ;?></span><br>
                          <br>
                          <strong style="padding-right: 129px;font-family: 'Zilla Slab', cursive;font-size: 25px;">PRN
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $prn ;?></span><br>
                          <br>
                </div>
                        <div class="col-lg-12" style="margin-top: 2%;
                          border: solid 1px;
                          margin-left: 7%;
                          width: 86%;
                          padding-left: 3%;
                          border-radius: 21px;box-shadow: 10px 9px 18px #6b6868;background: white;">
                          <center><h4 style="margin-bottom: 2%;margin-top: 3%;">Education</h4></center>
                          <strong style="padding-right: 196px;font-family: 'Zilla Slab', cursive;font-size: 25px;">School
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $highschool ;?></span><br>
                          <br>
                          <strong style="padding-right: 37px;font-family: 'Zilla Slab', cursive;font-size: 25px;">College(+2/Diploma)
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $highercollege ;?></span><br>
                          <br>
                          
                        </div>

                        <div class="col-lg-12" style="margin-top: 2%;
                          border: solid 1px;
                          margin-left: 7%;
                          width: 86%;
                          padding-left: 3%;
                          border-radius: 21px;box-shadow: 10px 9px 18px #6b6868;background: white;">
                          <center><h4 style="margin-bottom: 2%;margin-top: 3%;">Basic Information</h4></center>                         
                          <strong style="padding-right: 111px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Hometown
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $hometown ;?></span><br>
                          <br>
                          <strong style="padding-right: 95px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Currentcity
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $currentcity ;?></span><br><br>
                          <strong style="padding-right: 134px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Address
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $address ;?></span><br>
                          <br>
                          <strong style="padding-right: 148px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Gender
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $gender ;?></span><br>
                          <br>
                          <strong style="padding-right: 111px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Mobile No
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $mobileNo ;?></span><br>
                          <br>
                          <strong style="padding-right: 98px;font-family: 'Zilla Slab', cursive;font-size: 25px;">Social links
                          </strong><span style="font-size: 151%;"><b>: </b><?php echo $sociallinks ;?></span><br>
                          <br>
                        </div>  
</div>

</body>
</html>