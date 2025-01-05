    <!DOCTYPE html>
    <html lang="en">
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </head>
    </html>
    
    <?php  
    if(isset($_POST["faculty_id"]))  
    {  
        $output = '';  
        $connect = mysqli_connect("localhost", "root", "", "college");  
        $query = "SELECT * FROM faculty WHERE facultyid = '".$_POST["faculty_id"]."'";  
        $result = mysqli_query($connect, $query);  
        $output .= '  
        <div class="table-responsive">  
            <table class="table table-striped table-bordered ">';  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '  
                    <tr>  
                        <td width="30%"><label>Faculty ID</label></td>  
                        <td width="70%">'.$row["facultyid"].'</td>  
                    </tr> 
                    <tr>  
                        <td width="30%"><label>Name</label></td>  
                        <td width="70%">'.$row["fname"]." ".$row["mname"]." ".$row["lname"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Department</label></td>  
                        <td width="70%">'.$row["department"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Designation</label></td>  
                        <td width="70%">'.$row["designation"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Address</label></td>  
                        <td width="70%">'.$row["address"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Email</label></td>  
                        <td width="70%">'.$row["email"].'</td>  
                    </tr>  
                    <tr>  
                        <td width="30%"><label>Mobile No</label></td>  
                        <td width="70%">'.$row["mb"].'</td>  
                    </tr>  
                    ';  
        }  
        $output .= "</table></div>";  
        echo $output;  
    }  
    ?>