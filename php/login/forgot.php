<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body style="background: black;">
<form action="./verification.php" method='POST'>
        <div style="width: 38%;margin-top: 11%;margin-left: 34%;" class="card">
        <div class="card-header">
            Forget Password
        </div>
        <div class="card-body">
            <h5 class="card-title">Enter your Registered Email</h5>
            <input type="email" name='email' class="form-control" placeholder="abc@gmail.com" required>
        </div>
        <strong><p style="margin-left: 3%;margin-bottom: 1%;">Select Account: </p></strong>
        <div class="btn-group" style="width: 94%;margin-left: 3%;" role="group">
            <input type="radio" class="btn-check" name="btnradio" value="admin" id="btnradio1" autocomplete="off" required>
            <label class="btn btn-outline-primary" for="btnradio1">Admin</label>

            <input type="radio" class="btn-check"  name="btnradio" value="faculty" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Faculty</label>

            <input type="radio" class="btn-check"  name="btnradio" value="student" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">Student</label>
        </div>  
        <input style="margin-top: 5%;" type='submit' value='Submit' name='forgetpass' class="btn btn-primary">
        </div>
</form>
        
</html>