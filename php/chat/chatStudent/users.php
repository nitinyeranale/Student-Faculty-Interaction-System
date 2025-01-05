<?php 
  session_start();
  if(!isset($_SESSION['username']))
  {
    header('Location:../../login/login.php');
  }
  include_once "php/config.php";
  include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $combine=$_SESSION["username"];
            $arr=explode(" ",$combine);
            $sprn=$arr[0];
            $sql=mysqli_query($conn, "UPDATE chatusers SET chat_status='Active now' where prn='$sprn'");
            $sql = mysqli_query($conn, "SELECT * FROM chatusers where prn='$sprn'");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="../../../images/profilepics/<?php echo $row['profilename']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['chat_status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['prn']; ?>" class="logout">Exit</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
</body>
</html>
