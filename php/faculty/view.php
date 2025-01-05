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
<?php
    $ass_id=$_GET['id'];

    $connection = mysqli_connect("localhost","root","","college");
    $query="SELECT assignmentssubmitted.prn,student.fname,student.mname,
        student.lname,assignmentssubmitted.submittedAt,assignmentssubmitted.filename
        from assignmentssubmitted INNER join student 
        USING(prn) where id=$ass_id";
    $query_run = mysqli_query($connection, $query);
    ?>
    <div style="width: 94%;margin-left: 3%;margin-top: 2%;">
        <table id="myTable" >
            <tr class="header" >
                <th>PRN</th>
                <th>Name</th>
                <th>submitted At</th>
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
                <td><?php echo $row['fname']." ".$row['mname']." ".$row['lname']?></td>
                <td><?php echo $row['submittedAt'] ?></td>
                <td>
                <a href="submissions/<?php echo $row['filename'] ?>">
                    <button onclick="" type="button" class="btn btn-danger">View</button>
                </a> 
                <a href="submissions/<?php echo $row['filename'] ?>" download>
                    <button class="btn btn-primary">Download</button>
                </a>
                </td>
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
