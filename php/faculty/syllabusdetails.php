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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
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

        table {
            width: 60%;
            border-collapse: collaspe;
            margin: 40px auto
        }

        tr,
        td,
        th {
            text-align: center;
            height: 40px;
            vertical-align: center;
            border: 1px solid black;


        }

        th {
            font-weight: bold;
            font-size: 23px;
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
    margin-top: 1%;" class="text-center text-white">Syllabus Details<button style="float: right;margin-right: 1%;"
            class="btn btn-warning" onclick="window.location.href='profile1.php'">Dashboard</button></h3>
 
    <?php


    $conn = mysqli_connect ('localhost', 'root', '', 'college') or die(mysqli_error());

    $sql = "SELECT * FROM syllabus";
   
   $result = mysqli_query($conn, $sql);
   
   $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
   <!-- <span style="margin-left: 3%;
   font-weight: bold;
   font-size:23px">Select Class:</span> -->
   <span style="margin-left: 3%;
             font-weight: bold;
             font-size:23px">Select Class:</span>


<input style="width:50%;margin-left: 3%;
   margin-top:5%;" id="myInput" onkeyup="myFunction()" placeholder="Search with Class...">
<?php

echo "<table id=\"myTable\" class='table'
                                
             <tr>
                <th>File Name</th>
                <th >For Class</th>
                <th>Action</th>
                <th>Operation</th>
             </tr>";

             foreach($files as $file)
{  echo "<tr>";

// echo "<td>$file[id]</td>"; 
echo "<td>$file[pdf]</td>"; 
echo "<td>$file[type]</td>"; 
echo "<td><button><a href=\"../student/syllabus/$file[pdf]\">View Syllabus</a></button></td>";


echo " <td>


        <form action=\"deleteSyllabus.php\" method=\"POST\">
                <input type=\"hidden\" name=\"delete_id\" value=\"$file[id]\">
                <input type=\"hidden\" name=\"delete_file\" value=\"$file[pdf]\">
                <button type=\"submit\" name=\"Delete\" class=\"btn btn-danger\" onclick=\"return checkdelete()\">Delete</button>
        </form>

      </td>";



echo "</tr>";     
}

echo "</table>";
?>
  
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
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

</script>
    <script>
        function checkdelete() {
            return confirm('Are You Sure You Want To Delete');
        }
    </script>

