<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
    #register_student
    {
        padding-top:5%;
        padding-bottom:4%;
        height: 100vh;
    }
    #register_student_header
    {
        background: #a8fb93;
        padding: 8px 0 8px 0px;
        width: 951px;
        margin-left:7%;
    }
    #register_student_form
    {
        margin-left: 7%;
        padding-top: 2%;
        padding-bottom: 3%;
    }
    #register_student_btn:hover
    {
        box-shadow: 5px 5px 0px 0px black;
    }
    </style>
</head>
<body>
<section class="bg-dark" id="register_student" style="background-image: url(../../../images/7.jpg);" >
  <div class="container" style="background: whitesmoke;padding-top: 3%;">
  <h1 id="register_student_header"><center>Student Register</center></h1>
  <form id="register_student_form" name="myForm" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>First Name</label>
      <input style="width: 76%;" name="fname" type="text" class="form-control"  placeholder="First Name" required>
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
    <label >Department</label>
      <select name=department class="form-control"  style="width: 76%;">
        <option value="MCA" selected>MCA</option>
        <option value="ETC">ETC</option>
        <!-- <option value="ETC">ETC</option> -->
        <option value="CIVIL">CIVIL</option>
        <option value="CSE">CSE</option>
        <!-- <option value="ETC">ETC</option> -->
        <option value="MECH">MECH</option>
      </select>

    </div>
    <div class="form-group col-md-2">
    <label >Class</label>
      <select name=class class="form-control"  style="width: 81%;">
        <option value="FY">FY</option>
        <option value="SY">SY</option>
        <option value="TY" selected>TY</option>
        <option value="FINAL YEAR">FINAL YEAR</option>
      </select>
    </div>
    <div class="form-group col-md-2">
    <label >Division</label>
    <select name='division' class="form-control"  style="width: 51%;">
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
      <input name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width: 83%;" class="form-control"  placeholder="xyz@gmail.com"  required>
    </div>
    </div><br>
  <input id="register_student_btn" name='btnsubmit' style="width: 12%;" type="submit"  value="Register" class="btn btn-primary">
</form>
  </div>
</section>
</body>
</html>

<?php
  if(isset($_POST['btnsubmit']))
  {
    $prn=$_POST['prn'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $department=$_POST['department'];
    $email=$_POST['email'];
    $class=$_POST['class'];
    $division=$_POST['division'];
    $conn=new mysqli('localhost','root','','college');
    if($conn->connect_error)
    {
        die("Error in db connection".$conn->connect_error);
    }
    else
    {
        $sql="INSERT INTO student (`prn`,`fname`, `mname`, `lname`, `department`,`email`,`status`,`class`,`division`)VALUES(UPPER('$prn'),'$fname','$mname','$lname','$department','$email','not approved','$class','$division')";
        $result=$conn->query($sql);
        if($result)
        {
          $sql="INSERT INTO chatUsers (`prn`,`fname`,`lname`)VALUES(UPPER('$prn'),'$fname','$lname')";
          $result=$conn->query($sql);
          echo "<script>alert('Your account request is now pending for approval. Please wait for confirmation.Thank you!!');
          window.location.href='../../../index.html';  
          </script>";   
        }
        else
        {
          echo "<script>alert('Unknown error occured.')</script>";
        }
        $conn->commit();
        $conn->close();
    }


  }
?>