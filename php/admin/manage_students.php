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
    margin-top: 1%;" class="text-center text-white">Manage Students <button style="float: right;margin-right: 1%;"  class="btn btn-warning" onclick="window.location.href='./home.php'">Dashboard</button></h3>

<input style="width: 94%;margin-left: 3%;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search with PRN....">
<?php

    $connection = mysqli_connect("localhost","root","","college");
    $query="SELECT * FROM student where `status`='approved'";
    $query_run = mysqli_query($connection, $query);
    ?>
    <div style="width: 94%;margin-left: 3%;">
        <table id="myTable" >
            <tr class="header" >
                <th>PRN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Class</th>
                <th>Div</th>
                <th>Action</th>
            </tr>
            <?php
                    if(mysqli_num_rows($query_run)>0)
                    {
                        while($row =mysqli_fetch_array($query_run))
                        {
            ?>
            <tr>
                <td><?php echo $row['prn'] ?></td>
                <td><?php echo $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['department'] ?></td>
                <td><?php echo $row['class'] ?></td>
                <td><?php echo $row['division'] ?></td>
                <td><button onclick="window.location.href='delete.php?id=<?php echo $row['prn'].' '.'student'?>'" type="button" class="btn btn-danger">Delete</button></td>
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
    <?php
    
    ?>
<script>
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
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
