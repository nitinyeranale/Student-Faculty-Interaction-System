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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>Document</title>

  <style>
   

.container{
     margin-top:48px;
    border: 3px outset black;
  background-color:white; 
  text-align: center;

}

  
  </style>
</head>

<body>
<div class="container">
  <center>
    <form method="post">
      <div class="mb-3">
      <p class="h1" style="color:#42252f ; background-color:#cfd8dc ; margin-top:48px; margin-bottom:30px" >Send Notifications Here</p>
        </div> 
        <label  style="color:blue"><h5>Choose a Department:</h5></label>
      <select name="department" style="color:black">
        <option value="MCA" selected>MCA</option>
        <option value="MECH">MECH</option>
        <option value="ENTC">ENTC</option>
        <option value="CSE">CSE</option>
        <option value="CIVIL">CIVIL</option>
        <option value="ELECTRICAL">ELECTRICAL</option>
      </select>&nbsp &nbsp
      <label style="color:blue"><h5>Choose a class:</h5></label>
      <select name="class" style="color:black">
        <option value="SY" selected>SY</option>
        <option value="TY">TY</option>
        <option value="FY">FY</option>
      </select>&nbsp &nbsp

      <label style="color:blue"><h5>Choose a Division:</h5></label>
      <select name="div" style="color:black">
        <option value="A" selected>A</option>
        <option value="B">B</option>
      </select><br><br>
      <div>
      <!-- <input type="textarea" name="Notification" id="#" cols="30" rows="10" style="width: 450px; height: 170px; "required> -->
        <textarea  name="Notification" id="#" cols="30" rows="10" style="width: 450px; height: 170px; "required></textarea><br>

      </div><br>
      <button type="submit" value="submit" name="submit" 
        style="font-size:20px ; background-color:green; color:white ; margin-bottom:15px; border-radius: .25rem;">Send</button>
        <button  style="font-size:20px ; background-color:green; color:white ; margin-bottom:15px; border-radius: .25rem; margin-left:15px" onclick="window.location.href='profile1.php'">Dashboard</button> 


    </form>
    

      
     </center>
  </div>
</body>

</html>

 <?php
  
    
    if(isset($_POST['submit']))
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
              
            $class = $_POST['class'];
            $div = $_POST['div'];
            $dept = $_POST['department'];
            $note = $conn -> real_escape_string($_POST['Notification']);
            $type = $class."-".$dept."-".$div;
            $sql="INSERT INTO circular (`type`,`notification`,`sentby`,`time`)VALUES('$type','$note','$facultyid',CURRENT_TIMESTAMP)";
            $result=$conn->query($sql);
            if($result)
            {
              echo '<script>
              alert("Notification Sent!"); 
              window.location = "notification.php";
              </script>';   
            }
            else
            {
              echo "<script>alert('Unknown error occured.')</script>";
            }
            $conn->commit();
            $conn->close();
    }
  





?>