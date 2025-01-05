<?php
// Load the database configuration file
include_once 'dbConfig.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = '1';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = '2';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = '3';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
<!-- Display status message -->
<?php 
if(!empty($statusMsg))
{
    if($statusMsg=='1')
    {
    ?>
    <script>alert("Data added successfully!!!");
    window.location.href='../home.php';
    
    </script>
    <?php }
    else if($statusMsg=='2')
    {
    ?>
    <script>alert("Some problem occurred, please try again.");
    window.location.href='../home.php';

    </script>
    <?php }
    else
    {
    ?>
    <script>alert("Please upload a valid CSV file.");
    window.location.href='../home.php';

    </script>
    <?php }
}

  
  ?>