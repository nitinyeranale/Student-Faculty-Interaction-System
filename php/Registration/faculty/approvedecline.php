<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header('Location:../../login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        #myInput {
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        #myTable th,
        #myTable td {
            text-align: left;
            padding: 12px;
            padding-left: 7%;

        }

        #myTable tr {
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header {
            background-color: #9fffa2;
        }

        #myTable tr.header:hover {
            background-color: #9fffa2;
        }

        #myTable tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h3 style="background: black;
    height: 66px;
    padding-top: 1%;
    margin-bottom: 2%;
    width: 94%;
    margin-left: 3%;
    margin-top: 1%;" class="text-center text-white">Faculty Approval Requests <button
            style="float: right;margin-right: 1%;" class="btn btn-warning"
            onclick="window.location.href='../../admin/home.php'">Dashboard</button></h3>
</body>

</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $sql = "SELECT * FROM `faculty` WHERE STATUS='not approved'"  ;
    $result = $conn->query($sql);
?>
<div style="width: 94%;margin-left: 3%;">
    <table id="myTable">
        <tr class="header">
            <th>FacultyID</th>
            <th>Name</th>
            <th style="padding-left:21%">Action</th>
        </tr>
        <?php
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $name=$row["fname"]." ".$row["mname"]." ".$row["lname"];
                ?>
        <tr>
            <td><?php echo $row['facultyid'];?></td>
            <td><?php echo $name ?></td>
            <td>
                <button onclick="window.location.href='accept.php?id=<?php echo $row['facultyid']?>'" type="button"
                    class="btn btn-primary" style="margin-left: 20%;">Approve</button>
                <button onclick="window.location.href='decline.php?id=<?php echo $row['facultyid']?>'" type="button"
                    class="btn btn-danger">Decline</button>
                <input class="btn btn-success view_data" type="button" name="view" value="Details"
                    id="<?php echo $row["facultyid"]; ?>" style="width: 19%;">
            </td>
        </tr>

        <?php
                        }
                }
                else
                {
                    ?>
        <tr>
            <td colspan="6">No Pending Requests</td>
        </tr>
        <?php
                }
            ?>
    </table>
</div>
<div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Faculty Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="faculty_detail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.view_data').click(function () {
            var faculty_id = $(this).attr("id");
            $.ajax({
                url: "select.php",
                method: "post",
                data: {
                    faculty_id: faculty_id
                },
                success: function (data) {
                    $('#faculty_detail').html(data);
                    $('#dataModal').modal("show");
                }
            });
        });
    });
</script>