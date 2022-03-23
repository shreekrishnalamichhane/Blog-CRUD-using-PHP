<?php
require('./database/connection.php');
require('./assets/vendor/erusev-parsedown/Parsedown.php');
require('./partials/variables.php');
$Parsedown = new Parsedown();
$title = '';
$description = '';
$image = '';
$updated_at = '';
$is404 = false;
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT id, title, description,image, DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') AS updated_at FROM `posts` WHERE id = '" . $id . "';";
  $post = mysqli_query($connection, $sql);
  if (mysqli_num_rows($post) > 0) {
    while ($row = mysqli_fetch_assoc($post)) {
      $title = $row['title'];
      $description = $row['description'];
      $image = $row['image'];
      $updated_at = $row['updated_at'];
    }
  } else {
    $is404 = true;
  }
} else {
  $is404 = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show | Blogs</title>
  <?php
  require './partials/styles.php';
  ?>
</head>

<body>
  <div class="container">
    <?php
    require './partials/navbar.php';
    require './partials/message.php';
    ?>

    <?php
    if ($is404) {
    ?>
      <div class="d-flex flex-column justify-content-center align-items-center" style="height: 90vh;">
        <h1 class="p-0 m-0 pb-2">404 Error</h1>
        <h5 class="p-0 m-0">Page Not Found</h5>
      </div>
    <?php
    } else {
    ?>
      <div class="container  w-50 my-5">
        <img class="w-100" src="<?php echo $app_path ;?><?php echo $image ?>" width="20px" alt="">
        <h2 class="mt-3 text-start "><?php echo $title ?></h2>
        <h6 class=" text-start"><?php echo $updated_at ?></h6>
        <p class="my-3 text-start"><?php echo $Parsedown->text($description) ?></p>
      </div>
    <?php
    }
    ?>
  </div>
  <?php
  require './partials/scripts.php';
  ?>
</body>

</html>