<?php
session_start();

if(!isset($_SESSION["username"]))
{
    header('Location:../login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="assignmentTable.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #myTable td {
            text-align: left;
            padding: 12px;
        }

        #myTable {
            width: 100%;
            font-size: 18px;
            border-radius: 16px;
            border: none;
            opacity: 85%;
        }

        input#myInput:focus {
            outline: none;
        }
    </style>
</head>
<h3 style="background: black;
    height: 66px;
    padding-top: 1%;
    margin-bottom: 2%;
    width: 94%;
    margin-left: 3%;
    margin-top: 1%;" class="text-center text-white">Notification Details
    
    <button style="float: right;margin-right: 1%;" class="btn btn-warning" onclick="window.location.href='profile1.php'">Dashboard</button>

        <form action="deletenotification.php" method="POST">
                                <button style="float: right;margin-right: 3%;margin-top: -33px;" type="submit" name="Delete" class="btn btn-danger"
                                    onclick="return checkdelete()">Delete</button>
        </h3>
    

<body style="height:100%;background-size:cover;background-image:url(../../images/13.jpg);background-attachment: fixed;">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div style="padding-left: 1%;" class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav items ">


                </div>
            </div>
    </nav>       

    <?php
            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $femail=$arr[0];
            $connection = mysqli_connect("localhost","root","","college");
            if($connection->connect_error)
            {
                die("Error in db connection".$conn->connect_error);
            }
            $query = "select * from `faculty` where `email` = '$femail'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $facultyid=$row['facultyid'];
                }
            }
            $query="SELECT * from circular where `sentby`=$facultyid ORDER BY `time` DESC";
            $query_run = mysqli_query($connection, $query);
    ?>
    <div style="width: 94%;margin-left: 3%;margin-top: 2%;">
        <input style="margin-top: 5%;margin-bottom:0%;border-radius: 11px;" type="text" id="myInput"
            placeholder="Search...">
        <table id="myTable" style="background: white;">
            <?php
                            if(mysqli_num_rows($query_run)>0)
                            {
                                while($row =mysqli_fetch_array($query_run))
                                {
                    ?>
            <tr>
                <td>
                    <p style="font-size: 17px;"><?php echo $row['time']?></p>
                    <p style="font-size: 17px;">To: <?php echo $row['type']?></p>
                    <?php echo $row['notification'] ?>
                </td>
                <td>
                    <input type="checkbox" name="delete_id[]" style="transform:scale(1.5);" value="<?php echo $row['id']; ?>">
                </td>

            </tr>

            <?php
                        }
                }
            ?>
    </form>
            <script>
                $(document).ready(function () {
                    $("#myInput").on("keyup", function () {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>

</body>

</html>

<script>
    function checkdelete()
        {
            if($("input[type=checkbox]").is(":checked"))
            {
                return confirm('Are You Sure You Want To Delete This Notification');
            }

            else
            {
            
                alert('Please select atleast one notification!!');
                return false;
            }
        }
</script>