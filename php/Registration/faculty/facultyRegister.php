<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        #add_faculty {
            padding-top: 29px;
            height: 100vh;
        }

        #add_faculty_header {
            background: #a8fb93;
            padding: 8px 0 8px 0px;
            width: 951px;
            margin-left: 7%;
            text-align: center;
        }

        #add_faculty_form {
            margin-left: 7%;
            padding-top: 2%;
            padding-bottom: 3%;
        }

        #add_faculty_btn:hover {
            box-shadow: 5px 5px 0px 0px black;
        }
    </style>
</head>

<body>
    <section class="bg-dark" id="add_faculty" style="background-image: url(../../../images/4.jpg);">
        <div class="container" style="background: whitesmoke;padding-top: 3%;">
            <h1 id="add_faculty_header">Faculty Register</h1>
            <form id="add_faculty_form" name="myForm" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>First Name</label>
                        <input style="width: 76%;" name="fname" type="text" class="form-control"
                            placeholder="First Name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Middle Name</label>
                        <input style="width: 76%;" name="mname" type="text" class="form-control"
                            placeholder="Middle Name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Last Name</label>
                        <input style="width: 76%;" name="lname" type="text" class="form-control" placeholder="Last Name"
                            required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Department</label>
                        <select name=department class="form-control" style="width: 76%;">
                            <option value="MCA" selected>MCA</option>
                            <option value="ETC">ETC</option>
                            <!-- <option value="ETC">ETC</option> -->
                            <option value="CIVIL">CIVIL</option>
                            <option value="CSE">CSE</option>
                            <!-- <option value="ETC">ETC</option> -->
                            <option value="MECH">MECH</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Designation</label>
                        <input name="designation" style="width: 128%;" type= text" class="form-control"
                            placeholder="Designation" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input name="address" style="width: 92%;" type="text" class="form-control"
                        placeholder="City ,Village ,floor" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width: 83%;" class="form-control"
                            placeholder="xyz@gmail.com" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Mobile No</label>
                        <input name="mbno" style="width: 84%;" type="text" class="form-control"
                            placeholder="10 Digit Mobile No" pattern="[7-9]{1}[0-9]{9}" title="Please Enter 10 digit Mobile No"
                            required>
                    </div>
                </div><br>
                <input id="add_faculty_btn" name='btnsubmit' style="width: 12%;" type="submit" value="Register"
                    class="btn btn-primary">
            </form>
        </div>
    </section>
</body>

</html>

<?php
    if(isset($_POST['btnsubmit']))
    {
        $fname=$_POST["fname"];
        $mname=$_POST["mname"];
        $lname=$_POST["lname"];
        $department=$_POST["department"];
        $designation=$_POST["designation"];
        $address=$_POST["address"];
        $email=$_POST["email"];
        $mobileno=$_POST["mbno"];
        $password=$_POST["email"];
        $conn=new mysqli('localhost','root','','college');
        if($conn->connect_error)
        {
            die("Error in db connection".$conn->connect_error);
        }
        else
        {
            $sql="INSERT INTO faculty(`fname`, `mname`, `lname`, `department`, `designation`, `email`, `mb`, `address`,`status`) VALUES('$fname','$mname','$lname','$department','$designation','$email','$mobileno','$address','not approved')";
            $result=$conn->query($sql);
            if($result)
            {
                $query = "select * from `faculty` where `email` = '$email'";
                $result = $conn->query($query);
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $facultyid=$row['facultyid'];
                    }
                }
                $sql="INSERT INTO chatusers (`prn`,`fname`,`lname`)VALUES('$facultyid','$fname','$lname')";
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