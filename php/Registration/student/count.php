<?php
$conn=new mysqli('localhost','root','','college');
if($conn->connect_error)
{
    die("Error in db connection".$conn->connect_error);
}



$sql = "SELECT count(*) as total from Student where status='not approved'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
//echo $row['total'];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}

.notification {
    background-color: #555;
    color: white;
    text-decoration: none;
    padding: 15px 26px;
    position: relative;
    display: inline-block;
    border-radius: 2px;
}

.notification:hover {
    background: red;
}

.notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 5px 10px;
    border-radius: 50%;
    background-color: red;
    color: white;
}
</style>
</head>
<body>

<h1>Notification Button</h1>

<a href="approvedecline.php" class="notification">
    <span>Inbox</span>
    <span class="badge"><?php echo $row['total']; ?></span>
</a>

</body>
</html>