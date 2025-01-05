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
  if($flag!='a')
  {
    header('Location:../login/login.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">
  <style>
    #Home {
      background-image: url(../../images/image.jpg);
      height: calc(100vh);
      background-repeat: no-repeat;
      width: 100%;
      background-size: cover;
      background-attachment: fixed;
    }
    
    #add_faculty {
      margin-bottom: 30px;
      padding-top: 4%;
      padding-bottom: 4%;
    }

    #add_faculty_header {
      background: #ff75ba;
      padding: 8px 0 8px 0px;
      width: 951px;
      margin-left: 7%;
    }

    #add_faculty_form {
      margin-left: 7%;
      padding-top: 2%;
      padding-bottom: 3%;
    }

    #add_faculty_btn:hover {
      box-shadow: 5px 5px 0px 0px black;
    }

    #add_faculty_by_csv {
      margin-bottom: 30px;
      padding-top: 4%;
      padding-bottom: 4%;
    }

    #add_student_by_csv {
      margin-bottom: 30px;
      padding-top: 4%;
      padding-bottom: 4%;
    }

    #add_student {
      margin-bottom: 30px;
      padding-top: 4%;
      padding-bottom: 4%;
    }

    #addAdmin {
      margin-bottom: 30px;
      padding-top: 4%;
      padding-bottom: 4%;
    }

    .notification {
      text-decoration: none;
      position: relative;
      display: inline-block;
    }

    .notification .badge {
      padding: 4px 6px;
      border-radius: 100%;
      background-color: red;
    }
    .img-src {
      width: 27%;
      margin-left: 39%;
      margin-top: 7%;
      border-radius: 50%;
    }
    #updatebtn:hover
        {
            box-shadow: 7px 9px 6px 0px #444444;
        }
  </style>


</head>

<body>

  <section id="Home" style="margin-bottom: 30px;">
    <div class="navigation-wrap" style="padding: 8px 0px 8px 12%;background: black;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-md">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto py-4 py-md-0" style="font-size: 122%;margin-right: 0%;">

                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link text-white" href="#">Home</a>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link dropdown-toggle text-white notification" data-toggle="dropdown" href="#"
                      role="button" aria-haspopup="true" aria-expanded="false">
                      Faculty
                      <?php
                        $conn=new mysqli('localhost','root','','college');
                        if($conn->connect_error)
                        {
                            die("Error in db connection".$conn->connect_error);
                        }
                        $sql = "SELECT count(*) as totalfac from faculty where status='not approved'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $conn->close();
                    ?>
                      <span class="badge"><?php  
                    $facreq=$row['totalfac'];
                    if($facreq > 0)
                    {
                      echo $facreq; 
                    }
                    ?></span>

                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#add_faculty">Add Faculty</a>
                      <a class="dropdown-item" href="#add_faculty_by_csv">Add Faculty By CSV</a>
                      <a class="dropdown-item notification" href="../Registration/faculty/approvedecline.php">
                        <span>Approval Requests</span>
                        <span class="badge"><?php 
                      if($facreq > 0)
                      {
                        echo $facreq; 
                      } 
                      ?></span>
                      </a>
                      <a class="dropdown-item" href="./manage_faculty.php">Manage Faculty</a>
                    </div>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link dropdown-toggle text-white notification" data-toggle="dropdown" href="#"
                      role="button" aria-haspopup="true" aria-expanded="false">
                      Student
                      <?php
                        $conn=new mysqli('localhost','root','','college');
                        if($conn->connect_error)
                        {
                            die("Error in db connection".$conn->connect_error);
                        }
                        $sql = "SELECT count(*) as total from Student where status='not approved'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $conn->close();
                    ?>
                      <span class="badge"><?php  
                    $studreq=$row['total'];
                    if($studreq > 0)
                    {
                      echo $studreq; 
                    }
                    ?></span>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#add_student">Add Student</a>
                      <a class="dropdown-item" href="#add_student_by_csv">Add Students By CSV</a>
                      <a class="dropdown-item notification" href="../Registration/student/approvedecline.php">
                        <span>Approval Requests</span>
                        <span class="badge"><?php 
                      if($studreq > 0)
                      {
                        echo $studreq; 
                      } 
                      ?></span>
                      </a>
                      <a class="dropdown-item" href="./manage_students.php">Manage Students</a>
                    </div>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link text-white " href="#addAdmin">Add Admin</a>
                  </li>
                  <button onclick="window.location.href='#profile'" style=" margin-left: 17rem;
                                  border-radius: 20px;
                                  padding-top: 0;
                                  padding-bottom: 0;
                                  height: 31px;
                                  margin-top: 4px;" class='btn btn-primary'>Profile
                  </button>
                  <button onclick="window.location.href='./adminlogout.php'" style=" margin-left: 1rem;
                          border-radius: 20px;
                          padding-top: 0;
                          padding-bottom: 1px;
                          height: 31px;
                          margin-top: 4px;" class='btn btn-danger'>Logout
                  </button>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <p style="padding-top: 43vh;
    font-size: 41px;
    color: white;
    width: 55%;
    margin-left: 22%;
    font-family: 'Girassol', cursive;" id="demo"></p>
  </section>

  <script>
        var i = 0;
        var txt = "Most of the really exciting things we do in our lives scare us to death. They wouldn't be exciting if they didn't!!!!!";
        var speed = 120;
        
        window.onload = function typeWriter() 
        { 
            if(i < txt.length)
            {
                document.getElementById("demo").innerHTML += txt.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            }
            else
            {
                sleep(2000);  
                document.getElementById("demo").innerHTML="";
                i=0;
                typeWriter();

            }
        }

        function sleep(milliseconds) 
        {
            let timeStart = new Date().getTime();
            while(true) 
            {
                let elapsedTime = new Date().getTime() - timeStart;
                if (elapsedTime > milliseconds) 
                {
                    break;
                }
            }
        }
    </script>



  <section class="bg-dark" id="add_faculty" style="background-image: url(../../images/7.jpg);">
    <div class="container" style="background: whitesmoke;padding-top: 3%;">
      <h1 id="add_faculty_header">Add Faculty</h1>
      <form id="add_faculty_form" action="./add_faculty.php" name="myForm" method="POST">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>First Name</label>
            <input style="width: 76%;" name="fname" type="text" class="form-control" placeholder="First Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Middle Name</label>
            <input style="width: 76%;" name="mname" type="text" class="form-control" placeholder="Middle Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input style="width: 76%;" name="lname" type="text" class="form-control" placeholder="Last Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Department</label>
            <select name=department class="form-select" style="width: 76%;">
              <option value="MCA" selected>MCA</option>
              <option value="ETC">ETC</option>
              <option value="CIVIL">CIVIL</option>
              <option value="CSE">CSE</option>
              <option value="MECH">MECH</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Designation</label>
            <input name="designation" style="width: 128%;" type="text" class="form-control" placeholder="Designation"
              required>
          </div>
        </div>

        <div class="form-group">
          <label>Address</label>
          <input name="address" style="width: 92%;" type="text" class="form-control" placeholder="City ,Village ,floor"
            required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Email</label>
            <input name="email" type="email" style="width: 83%;" class="form-control" placeholder="xyz@gmail.com"
              required>
          </div>
          <div class="form-group col-md-6">
            <label>Mobile No</label>
            <input name="mbno" style="width: 84%;" type="text" class="form-control" placeholder="10 Digit Mobile No"
              pattern="[7-9]{1}[0-9]{9}" title="Please Enter 10 digit Mobile No" required>
          </div>
        </div><br>
        <input id="add_faculty_btn" style="width: 12%;" type="submit" value="submit" class="btn btn-primary">
      </form>
    </div>
  </section>

  <section class="bg-dark" id="add_faculty_by_csv" style="background-image: url(../../images/4.jpg);">
    <div class="container" style="background: whitesmoke;padding-top: 3%;">
      <h1 id="add_faculty_header">Add Faculty By CSV</h1>
      <form id="add_faculty_form" action="./add_by_csv/importDataForFac.php" method="post"
        enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Choose CSV file</label>
          <input type="file" class="form-control" name="file" style="width: 92%;" required>
        </div>
        <input id="add_faculty_btn" style="width: 10%;margin-left: 39%;margin-top: 1%;" type="submit"
          class="btn btn-primary" name="importSubmit" value="Add">
      </form>
    </div>
  </section>

  <section class="bg-dark" id="add_student" style="background-image: url(../../images/7.jpg);">
    <div class="container" style="background: whitesmoke;padding-top: 3%;">
      <h1 id="add_faculty_header">Add Student</h1>
      <form id="add_faculty_form" action="./add_student.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>First Name</label>
            <input style="width: 76%;" name="fname" type="text" class="form-control" placeholder="First Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Middle Name</label>
            <input style="width: 76%;" name="mname" type="text" class="form-control" placeholder="Middle Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input style="width: 76%;" name="lname" type="text" class="form-control" placeholder="Last Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Department</label>
            <select name=department class="form-select" style="width: 76%;">
              <option value="MCA" selected>MCA</option>
              <option value="ETC">ETC</option>
              <option value="CIVIL">CIVIL</option>
              <option value="CSE">CSE</option>
              <option value="MECH">MECH</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label>class</label>
            <select name=class class="form-select" style="width: 76%;">
              <option value="FY">FY</option>
              <option value="SY" selected>SY</option>
              <option value="TY">TY</option>
              <option value="FINAL YEAR">FINAL YEAR</option>
            </select>
          </div>
          <div class="form-group col-md-2">
          <label >Division</label>
          <select name='division' class="form-select"  style="width: 51%;">
              <option value="A" selected>A</option>
              <option value="B">B</option>
          </select>
          </div>
          <div class="form-group col-md-4">
            <label>PRN</label>
            <input name="prn" style="width: 76%;" type="text" class="form-control" placeholder="e.g 18UCS015" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Email</label>
            <input name="email" type="email" style="width: 83%;" class="form-control" placeholder="xyz@gmail.com"
              required>
          </div>
        </div><br>
        <input id="add_faculty_btn" name='btnsubmit' style="width: 12%;" type="submit" value="Add"
          class="btn btn-primary">
      </form>
    </div>
  </section>

  <section class="bg-dark" id="add_student_by_csv" style="background-image: url(../../images/4.jpg);">
    <div class="container" style="background: whitesmoke;padding-top: 3%;">
      <h1 id="add_faculty_header">Add Student By CSV</h1>
      <form id="add_faculty_form" action="./add_by_csv/importDataForStu.php" method="post"
        enctype="multipart/form-data">
      <div id="add_faculty_form">
        <div class="mb-3">
          <label class="form-label">Choose CSV file</label>
          <input type="file" class="form-control" name="file" style="width: 92%;" required>
        </div>
        <input id="add_faculty_btn" style="width: 10%;margin-left: 39%;margin-top: 1%;" type="submit"
          class="btn btn-primary" name="importSubmit" value="Add">
        </form>
      </div>
  </section>

  <section class="bg-dark" id="addAdmin" style="background-size: cover;background-image: url(../../images/13.jpg);">
    <div class="container" style="background: whitesmoke;padding-top: 3%;">
      <h1 id="add_faculty_header" style="background:#c46ad4">Add New Admin</h1>
      <form id="add_faculty_form" action="add_admin.php" method="POST">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>First Name</label>
            <input style="width: 76%;" name="fnameAdmin" type="text" class="form-control" placeholder="First Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Middle Name</label>
            <input style="width: 76%;" name="mnameAdmin" type="text" class="form-control" placeholder="Middle Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input style="width: 76%;" name="lnameAdmin" type="text" class="form-control" placeholder="Last Name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Department</label>
            <select name=departmentAdmin class="form-select" style="width: 76%;">
              <option value="MCA" selected>MCA</option>
              <option value="ETC">ETC</option>
              <option value="CIVIL">CIVIL</option>
              <option value="CSE">CSE</option>
              <option value="MECH">MECH</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Designation</label>
            <input name="designationAdmin" style="width: 128%;" type="text" class="form-control" placeholder="Designation"
              required>
          </div>
        </div>

        <div class="form-group">
          <label>Address</label>
          <input name="addressAdmin" style="width: 92%;" type="text" class="form-control" placeholder="City ,Village ,floor"
            required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Email</label>
            <input name="emailAdmin" type="email" style="width: 83%;" class="form-control" placeholder="xyz@gmail.com"
              required>
          </div>
          <div class="form-group col-md-6">
            <label>Mobile No</label>
            <input name="mbnoAdmin" style="width: 84%;" type="text" class="form-control" placeholder="10 Digit Mobile No"
              pattern="[0-9]{10}" title="Please Enter 10 digit Mobile No" required>
          </div>
        </div><br>
        <input id="add_faculty_btn" style="width: 12%;" name="btnSubmitAdmin" type="submit" value="Add" class="btn btn-primary">
      </form>
    </div>
  </section>

  <section id="profile" style="background-color:white;padding-top:2%;padding-bottom: 3%;">
    <div class="container" style="background-image: url(../../images/14.jpg);background-size: cover;padding-top: 3%;">
      <h1 id="add_faculty_header" style="background:#79ff7d">Profile</h1>
      <div id="add_faculty_form">
        <div class='row'>
          <?php
            $value=$_SESSION["username"];
            $pieces=explode(" ",$value);
            $val1=$pieces[0];

            $conn=new mysqli('localhost','root','','college');
            if($conn->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
                $sql = "select * from `admin` where `email` = '$val1'; ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        
                        $id= $row['adminid'];
                        $profilepic=$row['profilename'];
                        $name=$row['fname'].' '.$row['mname'].' '.$row['lname'];
                        $department=$row['department'];
                        $designation=$row['designation'];
                        $address=$row['address'];
                        $email=$row['email'];
                        $mobileNo=$row['mobileno'];
                    }
                    // if($profilepic==NULL)
                    // {
                    //    $sql ="UPDATE admin SET `profilename`='default.png' where `email`='$email'" ;
                    //    $result = $conn->query($sql);
                    // }
                }
                $conn->close();
        ?>
          <div class='col-lg-6'
                style="margin-top: 0%;margin-left: 26%;border: solid 1px;width: 26rem;padding-bottom: 6vh;background-color: white;">
                <div class='col-lg-12' style="padding-top: 4%;background: linear-gradient(to right, #e91e63, #ffadad);;
            margin-top: 11px;
            padding-bottom: 8%;">
              <!-- <img src="./profilepics/<?php echo $profilepic;?>" class="img-src" alt="User-Profile-Image"> -->
        
              <div style="border: solid 1px;
              width: 32%;
              height: 107px;
              border-radius: 50%;
              margin-left: 35%;
              margin-top: 1%;
              overflow: hidden;">
                
                <img src="./profilepics/<?php echo $profilepic;?>" style="display: inline-block;
                width: 100%;
                height: 100%;"alt="User-Profile-Image">
            </div>
              <center>
                <h4 style="padding-top: 2%;"><?php echo $name ;?></h4>
              </center>
              <center style="padding-top: 1%;"><span
                  style="background-color: black;color: white;padding: 2px 10px 5px 11px;border-radius: 16px;">Admin</span>
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
              <center><button onclick="window.location.href='updateprofile.php?id=<?php echo $val1;?>'"
                  id="updatebtn" style="border-radius: 20px;" class="btn btn-primary">Update Profile</button></center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>