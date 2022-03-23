<?php
require('variables.php');
?>
<nav class="navbar ">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $app_path ;?>">
      <img src="<?php echo $app_path ;?>/assets/images/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
      BLOGPHP
    </a>
    <div class="d-flex gap-2">
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <?php 
      session_start();
      if($_SESSION['loggedin'] && $_SESSION['loggedin'] == true){
        ?>
        <p><?php echo $_SESSION['name'] ?></p>
        <a href="<?php echo $app_path?>/logout.php" class="btn btn-danger">Log Out</a>
        <?php }else{?>
          <a href="<?php echo $app_path?>/signup.php" class="btn btn-success">Sign Up</a>
        <a href="<?php echo $app_path?>/login.php" class="btn btn-primary">Log In</a>
        <?php }?>
    </div>
  </div>
</nav>