<?php
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 
    require '../Registration/student/vendor/autoload.php'; 

    if(isset($_POST['forgetpass']))
    {
            $email=$_POST['email'];
            $table=$_POST['btnradio'];

            $conn=new mysqli('localhost','root','','college');
            if($conn->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
            $query = "select * from $table where `email` = '$email'";
            $result = $conn->query($query);
            if($result)
            {
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        $pass=$row['password'];
                    }
                    $mail = new PHPMailer(true); 

                    try 
                    { 
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
                            $mail->FromName = "Sanjay Ghodawat university";

                            //To address and name
                            $mail->addAddress($email); //Recipient name is optional

                            //Address to which recipient will reply
                            $mail->addReplyTo("pratik@yourdomain.com", "Reply");
                        
                            $mail->isHTML(true);								 
                            $mail->Subject = 'Important!!'; 
                            $mail->Body = 'Your account Password is '.$pass; 
                            $mail->send(); 
                            if($mail)
                            {
                                echo "<script>
                                alert('Password is sent to registered Email!!')
                                window.location.href='./login.php';
                                </script>";
                            }      
                    }
                    catch (Exception $e) 
                    { 
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
                        header("Location:approvedecline.php");
                    } 
                }   
                else
                {
                    echo "<script>
                    alert('Email does not exist!!!');
                    window.location.href='./forgot.php';
                    </script>";
                }
            }
            else
            {
                echo "<script>
                alert('Unknown error occurred');
                window.location.href='./forgot.php';
                </script>";
            }
    }
            
        

?>