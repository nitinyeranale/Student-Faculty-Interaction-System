    <?php  
    session_start();

    if(!isset($_SESSION["username"]))
    {
        header('Location:../login/login.php');
    }
    else
    {
        if(isset($_POST["faculty_id"]))  
        {  
                $output = '';  
                $connect = mysqli_connect("localhost", "root", "", "college");  
                $query = "SELECT * FROM faculty WHERE facultyid = '".$_POST["faculty_id"]."'";  
                $result = mysqli_query($connect, $query);  
                $output .= '  
                <div class="table-responsive">  
                    <table class="table table-bordered">';  
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
    }
    
    ?>