<?php
    session_start();
    include_once "config.php";
    $combine=$_SESSION["username"];
    $arr=explode(" ",$combine);
    $sprn=$arr[0];

    $outgoing_id =$sprn;
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM chatusers WHERE NOT prn = '{$outgoing_id}' AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>
