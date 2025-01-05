<?php
session_start();

if(!isset($_SESSION["username"]))
{
        header('Location:../../login/login.php');
}
else
{

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .img-src
        {
            width: 12%;
            margin-left: 43%;
            margin-top: 0%;
            border-radius: 50%;
            margin-bottom: 1%;
            border: solid 0.1px;
            border-color: thistle;
        }
        #update
        {
            background: #ffc107;
            padding: 8px 0 8px 0px;
            width: 95%;
            margin-bottom: 4%;
        }
        #updatebtn:hover
        {
            box-shadow: 7px 9px 6px 0px #444444;
        }
        .eye:focus {
        outline: none;
        box-shadow: none;
        }
    </style>
</head>

</html>
<?php

$value=$_SESSION["username"];
$pieces=explode(" ",$value);
$val1=$pieces[0];


    $conn=new mysqli('localhost','root','','college');
        if($conn->connect_error)
        {
            die("Error in db connection".$conn->connect_error);
        }
        $sql = "select * from `student` where `prn` = '$val1' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $profile=$row['profilepic'];
                $name=$row['fname'].' '.$row['mname'].' '.$row['lname'];
                $department=$row['department'];
                $address=$row['address'];
                $email=$row['email'];
                $mobileNo=$row['mobileno'];
                $pass=$row['password'];
                $currentcity=$row['currentcity'];
                $highschool=$row['highschool'];
                $highercollege=$row['highercollege'];
                $hometown=$row['hometown'];
                $gender=$row['gender'];
                $sociallinks=$row['sociallinks'];
                // $quote=$row['quote'];
                $class=$row['class']; 

            }
        }
?>

<section style="background-image: url(../../images/12.jpg); background-size: cover;padding-top: 1%;padding-bottom: 1%;">
<div class="container" style="  background: whitesmoke;
    padding-left: 5%;
    padding-top: 3%;
    padding-bottom: 1%;
    margin-top: 3%;
    margin-bottom: 4%;
    border: solid 1px;">
<h1 id="update" class='text-center'>Update Profile</h1>
    <form method="POST" enctype='multipart/form-data'>
        <div class='form-row'>
            <div class="form-group col-md-12">
                <div style="border: solid 1px;
                    width: 13%;
                    height: 129px;
                    border-radius: 50%;
                    margin-left: 41%;
                    margin-top: -1%;
                    margin-bottom: 1%;
                    overflow: hidden;">
                <img src="../../../images/profilepics/<?php echo $profile;?>" style="display: inline-block;
                width: 100%;
                height: 100%;"alt="User-Profile-Image">
            </div>
            </div> 
        </div>
        <div class="form-row">     
            <div class="form-group col-md-4">
                <label><strong>Name</strong> </label>
                <input style="width: 85%;" name="name" value="<?php echo $name ?>" pattern="^(\w+)+\s+(\w+)+\s+(\w+)$" title="Enter full Name separated by spaces" type="text" class="form-control" >
            </div>
            <div class="form-group col-md-4">
                <label> <strong>Department</strong> </label>
                <select name=department style="width: 76%;" class="form-select">
                    <option style="display:none" value=<?php echo $department ?> selected><?php echo $department ?></option>
                    <option value="MCA">MCA</option>
                    <option value="ETC">ETC</option>
                    <option value="CIVIL">CIVIL</option>
                    <option value="CSE">CSE</option>
                    <option value="MECH">MECH</option>
                </select>
            </div><div class="form-group col-md-4">
                <label> <strong>Class</strong> </label>
                <select name=class style="width: 76%;" class="form-select">
                    <option style="display:none" value=<?php echo $class ?> selected><?php echo $class ?></option>
                    <option value="FY">FY</option>
                    <option value="SY">SY</option>
                    <option value="TY">TY</option>
                    <option value="B.Tech">B.Tech</option>
                   
                </select>
            </div>
        </div>
        <div class="form-row">     
            <div class="form-group col-md-4">
                <label><strong>Current city</strong> </label>
                <input style="width: 85%;" name="currentcity" value="<?php echo $currentcity ?>" type="text" class="form-control" >
            </div>
            
            <div class="form-group col-md-4">
                <label><strong>Hometown</strong></label>
                <input name="hometown" value="<?php echo $hometown ?>" style="width: 85%;" type="text" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label> <strong>Gender</strong> </label>
                <select name=gender style="width: 76%;" class="form-select">
                    <option style="display:none" value=<?php echo $gender ?> selected><?php echo $gender ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    
                </select>
            </div>
        </div>
        <div class="form-group">
            <label><strong>Address</strong></label>
            <input name="address" value="<?php echo $address ?>" style="width: 95%;" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label><strong>School</strong></label>
            <input name="school" value="<?php echo $highschool ?>" style="width: 95%;" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label><strong>College</strong></label>
            <input name="college" value="<?php echo $highercollege ?>" style="width: 95%;" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label><strong>Social links</strong></label>
            <input name="social" value="<?php echo $sociallinks ?>" style="width: 95%;" type="text" class="form-control">
        </div>
        <!-- <div class="form-group">
            <label><strong>Quote</strong></label>
            <input name="quote" value="<?php echo $quote ?>" style="width: 95%;" type="text" class="form-control">
        </div> -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label><strong>Email</strong></label>
                <input name="email" value="<?php echo $email ?>" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width: 83%;" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label><strong>Mobile No</strong></label>
                <input name="mobileno" value="<?php echo $mobileNo ?>" style="width: 42%;" type="text" class="form-control" pattern="[0-9]{10}" title="Please Enter 10 digit Mobile No" >
            </div>
            <div class=" form-group col-md-6 mb-3">
                <label><strong>Profile Picture</strong></label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" style="width: 83%;margin-top: 2px;">
            </div>
            <div class="form-group col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label style="padding-bottom: 4px;" class="form-check-label" for="flexCheckChecked">
                        <strong>Change Password</strong>   
                    </label>
                    <input style="border-right: none; width: 23rem;margin-left: -24px;margin-top: 4px;" value=<?php echo $pass ?> type="password" placeholder="New Password" class="form-control eye" name="newpass" id="newpassid" style="width: 92%;" disabled>  
                </div>
            </div>
            <div class="col-md-2">
            <button id="eyebtn" style="margin-top: 32px;
                height: 38px;
                background: none;
                border: 1px solid #ced4da;
                background-color: #e9ecef;
                border-left: none" 
                class='btn eye' onclick=" return showPassword()" disabled ><i style="font-size: 22px;" class='bx bxs-show'></i></button>
            </div>

            
        </div><br>
        <input id="updatebtn" name='btnsubmit' style="width: 12%;" type="submit" value="Save Changes" class="btn btn-primary">
    </form>
</div>
<script>
    document.getElementById('flexCheckChecked').onchange = function() 
    {
        document.getElementById('newpassid').disabled = !this.checked;
        if(document.getElementById('eyebtn').disabled==true)
        {
            document.getElementById('eyebtn').disabled=false;
        }
        else
        {
            document.getElementById('eyebtn').disabled=true;
        }
    };
    function showPassword() 
    {
        var x = document.getElementById("newpassid");
        if (x.type === "password") 
        {
            x.type = "text";
        } 
            else 
        {
            x.type = "password";
        }
        return false;
    } 
</script>
</section>


<?php 
if(isset($_POST['btnsubmit']))
{
    $name=$_POST['name'];
    $pieces=explode(" ",$name);
    $fname=$pieces[0];
    $mname=$pieces[1];
    $lname=$pieces[2];
    $class=$_POST['class'];
    $department=$_POST['department'];
    $currentcity=$_POST['currentcity'];
    $hometown=$_POST['hometown'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $mobileno=$_POST['mobileno'];
    $newpass=$_POST['newpass'];
    $highschool=$_POST['school'];
    $highercollege=$_POST['college'];
    $sociallinks=$_POST['social'];
    $quote=$_POST['quote'];

    if($newpass==NULL)
    {
        $newpass=$pass;
    }
    if($_FILES["fileToUpload"]["name"])
    {
        $file=$_FILES["fileToUpload"]["name"];
        $target_dir = "../../../images/profilepics/";
        $target_file = $target_dir.basename($file);
        if(file_exists($target_dir.$file))
        {
                $pdfname = $_FILES['pdf1']['name'];
                echo '<script> alert("This file is already exists!!! Change the file name and try again");
                window.location.href = "./updateprofile1.php";
                </script>';
        }
        else
        {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

            $sql = "UPDATE `student` SET `profilepic`='$file', `fname`='$fname',`mname`='$mname',`lname`='$lname',
                    `department`='$department',`class`='$class',`address`='$address',`email`='$email',`mobileno`='$mobileno',`currentcity`='$currentcity',`quote`='$quote',`hometown`='$hometown',`gender`='$gender',`highschool`='$highschool',`highercollege`='$highercollege',`sociallinks`='$sociallinks',`password`='$newpass' WHERE `prn`='$val1'";
            $flg=1;
        }
        
    }
    else
    {
        $sql = "UPDATE `student` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',
        `department`='$department',`class`='$class',`address`='$address',`email`='$email',`mobileno`='$mobileno',`currentcity`='$currentcity',`quote`='$quote',`hometown`='$hometown',`gender`='$gender',`highschool`='$highschool',`highercollege`='$highercollege',`sociallinks`='$sociallinks',`password`='$newpass' WHERE `prn`='$val1'";
        $flg=2;
    }
    $result = $conn->query($sql);
    if($result)
    {
        if($flg==1)
        {
            $sql="UPDATE chatusers SET fname='$fname',lname='$lname',profilename='$file' WHERE `prn`='$val1'";
        }
        else
        {
            $sql="UPDATE chatusers SET fname='$fname',lname='$lname' WHERE `prn`='$val1'";
        }
        $result = $conn->query($sql);
        echo "<script>
        alert('profile Updated Successfully!!');
        window.location.href='./profile.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('Unknown error occurred!!!');
        window.location.href='./profile.php';
        </script>";
    }
}
}

?>