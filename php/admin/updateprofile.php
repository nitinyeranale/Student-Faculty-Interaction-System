<?php
session_start();

if(!isset($_SESSION["username"]))
{
        header('Location:../login/login.php');
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
            background: #83a3ff;
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

    $id=$_GET['id'];

    $conn=new mysqli('localhost','root','','college');
        if($conn->connect_error)
        {
            die("Error in db connection".$conn->connect_error);
        }
        $sql = "select * from `admin` where `email` = '$id'; ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $profile=$row['profilename'];
                $name=$row['fname'].' '.$row['mname'].' '.$row['lname'];
                $department=$row['department'];
                $designation=$row['designation'];
                $address=$row['address'];
                $email=$row['email'];
                $mobileNo=$row['mobileno'];
                $pass=$row['password'];
            }
        }
   
?>

<section style="background-image: url(../../images/12.jpg); background-size: cover;padding-top: 1%;padding-bottom: 1%;">
<div class="container" style="  background: whitesmoke;
    padding-left: 5%;
    padding-top: 3%;
    padding-bottom: 1%;
    margin-top: 3%;
    margin-bottom: 4%;">
<h1 id="update" class='text-center'>Update Profile</h1>
    <form method="POST" enctype='multipart/form-data'>
        <div class='form-row'>
            <div class="form-group col-md-12">
                <!-- <img src="./profilepics/<?php echo $profile;?>" class="img-src" alt="User-Profile-Image" > -->
                <div style="border: solid 1px;
                    width: 13%;
                    height: 129px;
                    border-radius: 50%;
                    margin-left: 41%;
                    margin-top: -1%;
                    margin-bottom: 1%;
                    overflow: hidden;">
                <img src="./profilepics/<?php echo $profile;?>" style="display: inline-block;
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
            </div>
            <div class="form-group col-md-4">
                <label><strong>Designation</strong></label>
                <input name="designation" value="<?php echo $designation ?>" style="width: 85%; type=" text" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label><strong>Address</strong></label>
            <input name="address" value="<?php echo $address ?>" style="width: 95%;" type="text" class="form-control">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label><strong>Email</strong></label>
                <input name="email" value="<?php echo $email ?>" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width: 83%;" class="form-control" >
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

    $department=$_POST['department'];
    $designation=$_POST['designation'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $mobileno=$_POST['mobileno'];
    $newpass=$_POST['newpass'];
    if($newpass==NULL)
    {
        $newpass=$pass;
    }
    if($_FILES["fileToUpload"]["name"])
    {
        $file=$_FILES["fileToUpload"]["name"];
        $target_dir = "profilepics/";
        $target_file = $target_dir.basename($file);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        $sql = "UPDATE `admin` SET `profilename`='$file', `fname`='$fname',`mname`='$mname',`lname`='$lname',
                `department`='$department',`designation`='$designation',`address`='$address',`email`='$email',`mobileno`='$mobileno' WHERE `email`='$id'";
    }
    else
    {
        $sql = "UPDATE `admin` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',
        `department`='$department',`designation`='$designation',`address`='$address',`email`='$email',`mobileno`='$mobileno',`password`='$newpass' WHERE `email`='$id'";
    }
    $result = $conn->query($sql);
    if($result)
    {
        $_SESSION["username"]=$email.' '.'a';
        echo "<script>
        // alert('profile Updated Successfully!!');
        window.location.href='./home.php#profile';
        </script>";
    }
    else
    {
        echo "<script>
        alert('Unknown error occurred!!!');
        window.location.href='./home.php#profile';
        </script>";
    }
}
}

?>