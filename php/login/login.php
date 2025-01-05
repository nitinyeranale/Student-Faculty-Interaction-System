<?php 
session_start();

if(isset($_SESSION["username"]))
{$value=$_SESSION["username"];
    $pieces=explode(" ",$value);
    $val2=$pieces[1];
    
    if($val2=='a')
    {
        header('Location:../admin/home.php');
    }
    else if($val2=='f')
    {
        header('Location:../faculty/profile1.php');
    }
    else
    {
        header('Location:../student/home/studenthome.php');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	
<style>
    @import url('https://fonts.googleapis.com/css?family=Numans');

    html,body{
    background-image: url('../../images/loginbackground.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    height: 100%;
    font-family: 'Numans', sans-serif;
    }

    .container{
    height: 100%;
    align-content: center;
    }

    .card{
    height: 302px;;
    margin-top: auto;
    margin-bottom: auto;
    width: 400px;
    background-color: rgba(0,0,0,0.5) !important;
    }

    .social_icon span{
    font-size: 60px;
    margin-left: 10px;
    color: #FFC312;
    }

    .social_icon span:hover{
    color: white;
    cursor: pointer;
    }

    .card-header h3{
    color: white;
    }

    .social_icon{
    position: absolute;
    right: 20px;
    top: -45px;
    }

    .input-group-prepend span{
    width: 50px;
    background-color: #FFC312;
    color: black;
    border:0 !important;
    }

    input:focus{
    outline: 0 0 0 0  !important;
    box-shadow: 0 0 0 0 !important;

    }

    .remember{
    color: white;
    }

    .remember input
    {
    width: 20px;
    height: 20px;
    margin-left: 15px;
    margin-right: 5px;
    }

    .login_btn{
    color: black;
    background-color: #FFC312;
    width: 100px;
    }

    .login_btn:hover{
    color: black;
    background-color: white;
    }

    .links{
    color: white;
    }

    .links a{
    margin-left: 4px;
}

</style>
</head>
<body>
    <form name="f1" action = "authentication.php" onsubmit = "return validation()" method = "POST">
    <div class="container">
	<div class="d-flex justify-content-center h-100" style="padding-top: 11%;"> 
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body" style="height:10%">
				<form>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input class="form-control" placeholder="username" type = "text" id ="user" name  = "user">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input class="form-control" placeholder="password" type = "password" id ="pass" name  = "pass">
					</div>
					<div style="padding-bottom: 5px;" class="row align-items-center remember">
						<input type="checkbox" onclick="showPassword()">Show Password
                        <a style="padding-left: 21px;" href="./forgot.php" target='_blank'>Forget Password?</a>
					</div>
					<div class="form-group">
                        <input type="button" onclick="window.location.href='../../index.html'" style="margin-left: 7px;" value="Home" class="btn float-right login_btn">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
    </form>

    <script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }   
            function showPassword() 
            {
                var x = document.getElementById("pass");
                if (x.type === "password") 
                {
                    x.type = "text";
                } 
                else 
                {
                    x.type = "password";
                }
            } 
        </script>  

</body>
</html>