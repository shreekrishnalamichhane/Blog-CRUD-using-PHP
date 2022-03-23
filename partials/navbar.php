<?php
require('variables.php');
?>
<nav class="navbar ">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $app_path ;?>">
      <img src="<?php echo $app_path ;?>/assets/images/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
      BLOGPHP
    </a>
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>