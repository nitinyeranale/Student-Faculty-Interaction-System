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
    <title>Document</title>
     <link rel="stylesheet" href="style/fstyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<section id="profile" style="background-color:white;padding-top:2%;padding-bottom: 3%;">
    <div class="container" style="background-image: url(../../images/14.jpg);background-size: cover;padding-top: 3%;">
      <h1 id="add_faculty_header" style="background:#79ff7d;text-align:center;margin-top:0px;">Profile</h1>
      <div id="add_faculty_form">
        <div class='row'>
          <?php
                $facultyid="";
                $facultyid=$_GET['id'];
                if($facultyid=="")
                {
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
                      }
                  }
                  $conn->close();
                }
                $conn=new mysqli('localhost','root','','college');
                if($conn->connect_error)
                {
                    die("Error in db connection".$conn->connect_error);
                }
                $sql = "select * from `faculty` where `facultyid` ='$facultyid'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        
                        $id= $row['facultyid'];
                        $profilepic=$row['profile_pic'];
                        $name=$row['fname'].' '.$row['mname'].' '.$row['lname'];
                        $department=$row['department'];
                        $designation=$row['designation'];
                        $address=$row['address'];
                        $email=$row['email'];
                        $mobileNo=$row['mb'];
                    }
          
                }
                $conn->close();
        ?>
          <div class='col-lg-6'
            style="margin-bottom: 3%;margin-top: 3%;margin-left: 32%;border: solid 1px;width: 26rem;padding-bottom: 6vh;background-color: white;">
            <div class='col-lg-12' style="padding-top: 4%;background: linear-gradient(to right, #e91e63, #ffadad);;
        margin-top: 11px;
        padding-bottom: 8%;">
        
              <div style="border: solid 1px;
              width: 32%;
              height: 107px;
              border-radius: 50%;
              margin-left: 35%;
              margin-top: 1%;
              overflow: hidden;">
                
                <img src="../../images/profilepics/<?php echo $profilepic;?>" style="display: inline-block;
                width: 100%;
                height: 100%;"alt="User-Profile-Image">
            </div>
              <center>
                <h4 style="padding-top: 2%;"><?php echo $name ;?></h4>
              </center>
              <center style="padding-top: 1%;"><span
                  style="background-color: black;color: white;padding: 2px 10px 5px 11px;border-radius: 16px;">Faculty</span>
              </center>
            </div>
            <div class="col-lg-12" style="margin-top: 4%;">
              <strong style="padding-right: 74px;font-family: 'Zilla Slab', cursive;font-size: 17px;">Email
              </strong><span><b>: </b><?php echo $email ;?></span><br>
              <strong style="padding-right: 20px;font-family: 'Zilla Slab', cursive;font-size: 17px;">Department
              </strong><span><b>: </b><?php echo $department ;?></span><br>
              <strong style="padding-right: 23px;font-family: 'Zilla Slab', cursive;font-size: 17px;">Designation
              </strong><span><b>: </b><?php echo $designation ;?></span><br>
              <strong style="padding-right: 49px;font-family: 'Zilla Slab', cursive;font-size: 17px;">Address
              </strong><span><b>: </b><?php echo $address ;?></span><br>
              <strong style="padding-right: 35px;font-family: 'Zilla Slab', cursive;font-size: 17px;">mobile No
              </strong><span><b>: </b><?php echo $mobileNo ;?></span><br><br>
           
              <center>
              <button  id="updatebtn" style="border-radius: 20px;" class="btn btn-primary" onclick="window.location.href='profileupdate.php?id=<?php echo $facultyid;?>'">Update Profile</button>

              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>