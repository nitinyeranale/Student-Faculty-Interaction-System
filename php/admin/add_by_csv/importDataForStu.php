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
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel','application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $fname = $line[0];
                $mname = $line[1];
                $lname = $line[2];
                $department = $line[3];
                $class=$line[4];
                $division=$line[5];
                $prn=$line[6];
                $email = $line[7];

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM student WHERE prn = '".$line[6]."'";
                $prevResult = $db->query($prevQuery);
                
                if($prevResult->num_rows > 0)
                {
                    // Update member data in the database
                    $db->query("UPDATE student SET fname='$fname',mname='$mname',lname='$lname',department='$department',class='$class',division='$division',email='$email',status='approved',password=LOWER('$prn') WHERE prn ='$prn'");
                    $db->query("UPDATE chatusers SET fname='$fname',lname='$lname' WHERE prn ='$prn'");

                }
                else
                {
                    // Insert member data in the database
                    $db->query("INSERT INTO student(`prn`,`fname`, `mname`, `lname`, `department`,`email`,`status`,`class`,`division`,`password`)VALUES(LOWER('$prn'),'$fname','$mname','$lname','$department','$email','approved','$class','$division',LOWER('$prn'))");
                    $db->query("INSERT INTO chatusers(`prn`,`fname`,`lname`) VALUES(LOWER('$prn'),'$fname','$lname')");
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