<?php 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require 'vendor/autoload.php'; 
$combo=$_GET['id'];
$pieces = explode(" ", $combo);
$sendemail=$pieces[0];
$key=$pieces[1];

$mail = new PHPMailer(true); 

try { 
	$mail->SMTPDebug = 2;									 
	$mail->isSMTP();											 
	$mail->Host	 = 'smtp.gmail.com';					 
	$mail->SMTPAuth = true;							 
	$mail->Username = 'sgu.sanjay.ghodawat@gmail.com';
	$mail->Password = 'sgu@123';
	
	$mail->SMTPSecure = 'tls';							 
	$mail->Port	 = 587; 
	
		//From email address and name
		$mail->From = "sgu.sanjay.ghodawat@gmail.com";
		$mail->FromName = "Sanjay Godawat University";

		//To address and name
		$mail->addAddress($sendemail); //Recipient name is optional

		//Address to which recipient will reply
		$mail->addReplyTo("pratik@yourdomain.com", "Reply");

		//CC and BCC
		//$mail->addCC("cc@example.com");
		//$mail->addBCC("bcc@example.com");
	
	   //$mail->addAttachment("img1.jpg","file.txt");
	
	$mail->isHTML(true);								 
	$mail->Subject = 'Account Approved.........'; 
	$mail->Body = 'Your account is Approved by Administrator!!!! '; 
	$mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
	$mail->send(); 
	
	if($key=='fac')
	{
		echo "<script>
		window.location.href='../faculty/approvedecline.php';
		</script>";
	}
	else
	{
		echo "<script>
		window.location.href='approvedecline.php';
		</script>";
	}
} 
catch (Exception $e) 
{ 
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
	header("Location:approvedecline.php");
} 
?> 