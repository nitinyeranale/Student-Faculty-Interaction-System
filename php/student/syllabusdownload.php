<?php
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header('Location:../login/login.php');
    }
    if(isset($_POST['download']))
    {
        $cls=$_POST['class'];
        $dept=$_POST['department'];
        $type=$cls.'-'.$dept;
    $connection = mysqli_connect("localhost","root","","college");
    if($connection->connect_error)
    {
        die("Error in db connection".$conn->connect_error);
    }
    $query = "select * from `syllabus` where `type` = '$type'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $path=$row['pdf'];
        }
        $connection->close();
    //Clear the cache
    $url='syllabus/'.$path;
    clearstatcache();

    //Check the file path exists or not
    if(file_exists($url)) {

    //Define header information
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($url).'"');
    header('Content-Length: ' . filesize($url));
    header('Pragma: public');

    //Clear system output buffer
    flush();

    //Read the size of the file
    readfile($url,true);

    //Terminate from the script
    die();
    }
    else
    {
        echo "<script> alert('File does not exist!!!');</script>";
    }

    }
    
    else
    {
        $connection->close();
        echo "<script> alert('File does not exist!!!');
                window.location.href='./syllabus.php';
            </script>";
    }
}
?>