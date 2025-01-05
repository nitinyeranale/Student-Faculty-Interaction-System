<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header('Location:../login/login.php');
}
else
{
   // Load the database configuration file
include_once 'dbConfig.php';

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE)
            {
                // Get row data
                $fname = $line[0];
                $mname = $line[1];
                $lname = $line[2];
                $department = $line[3];
                $designation = $line[4];
                $email = $line[5];
                $mobileno = $line[6];
                $address = $line[7];

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM faculty WHERE email = '".$line[5]."'";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows > 0)
                {
                    // Update member data in the database
                    $db->query("UPDATE faculty SET fname='$fname',mname='$mname',lname='$lname',department='$department',designation='$designation',email='$email',mb='$mobileno',address='$address',password='$email' WHERE email ='$email'");
                    if($conn->connect_error)
                    {
                        die("Error in db connection".$conn->connect_error);
                    }
                    $query = "select * from `faculty` where `email` = '$email'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                            $facultyid=$row['facultyid'];
                        }
                    }
                    $sql="UPDATE chatusers SET fname='$fname',lname='$lname' where prn='$facultyid'";
                    $result=$conn->query($sql);
                    
                }else
                    {
                    // Insert member data in the database
                    $db->query("INSERT INTO faculty(`fname`, `mname`, `lname`, `department`, `designation`, `email`, `mb`, `address`, `password`,`status`) VALUES('$fname','$mname','$lname','$department','$designation','$email','$mobileno','$address','$email','approved')");
                    $conn=new mysqli('localhost','root','','college');
                    if($conn->connect_error)
                    {
                        die("Error in db connection".$conn->connect_error);
                    }
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
                    $conn->close();
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }
        else
        {
            $qstring = '?status=err';
        }
    }
    else
    {
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location:storage_confirmation.php".$qstring); 
}

?>