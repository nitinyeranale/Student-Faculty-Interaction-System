<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header('Location:../login/login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
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

#myTable th, #myTable td {
    text-align: left;
    padding: 12px;
}

#myTable tr {
    border-bottom: 1px solid #ddd;
}

#myTable tr.header{
    background-color: #9fffa2;
}
#myTable tr.header:hover{
    background-color: #9fffa2;
}
#myTable tr:hover 
{
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
    margin-top: 1%;" class="text-center text-white">Given Assignments<button style="float: right;margin-right: 1%;"  class="btn btn-warning"  onclick="window.location.href='Assignment.php'">Back  </button></h3>
<strong style="margin-left: 3%;">Search with : </strong> 
<select name="choice" id="myChoice" class="form-select" style="width:11%;margin-left: 3%;margin-bottom: 1%;">
    <option value="0">ID</option>
    <option value="1">Name</option>
    <option value="2">Class</option>
    <option value="3">Subject</option>
</select>


<input style="width: 94%;margin-left: 3%;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search....">
<?php

    $combine=$_SESSION["username"];
    $arr=explode(" ",$combine);
    $semail=$arr[0];

    $connection = mysqli_connect("localhost","root","","college");

    $query = "select * from `faculty` where `email` = '$semail'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $facultyid=$row['facultyid'];
        }
    }

    $query="SELECT * FROM assignmentsgiven where givenby='$facultyid'";
    $query_run = mysqli_query($connection, $query);
    ?>
    <div style="width: 94%;margin-left: 3%;">
        <table id="myTable" >
            <tr class="header" >
                <th>ID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Given At</th>
                <th>Action</th>
            </tr>
            <?php
                    if(mysqli_num_rows($query_run)>0)
                    {
                        while($row =mysqli_fetch_array($query_run))
                        {
            ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['class'] ?></td>
                <td><?php echo $row['subject'] ?></td>
                <td><?php echo $row['givenAt'] ?></td>
                <td><button onclick="window.location.href='view.php?id=<?php echo $row['id']?>'" type="button" class="btn btn-primary">View Sub</button>
                <button onclick="window.location.href='deleteAssignment.php?id=<?php echo $row['id']?>'" type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            
            <?php
                        }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="6">No record found</td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
<script>
function myFunction() {
    var a=document.getElementById("myChoice").value;
    a=parseInt(a);
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[a];
        if(td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
}
</script>

</body>
</html>
