<?php
require('./database/connection.php');
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
  <link rel="stylesheet" href="./assets/vendor/simplemde/css/simplemde.min.css">
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
      <div class="container ">
        <form method="POST" action="./controllers/update.php" class="py-5 mx-5 px-5" enctype="multipart/form-data">
          <h2 class="pb-3">Edit Blog</h2>
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <input type="hidden" name="oldImage" value="<?php echo $image ?>">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title here." value="<?php echo $title ?>" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control" id="description" name="description" placeholder="Your content here." rows="5" required><?php echo $description ?></textarea>
          </div>

          <div class="mb-3">
            <label for="" class="form-label">Previous Image</label><br>
            <img class="rounded pb-3" src="<?php echo $image ?>" alt="">
            <br>
            <label for="image" class="form-label">Upload Image (Optional)</label>
            <br>
            <input type="file" name="image" id="image" accept=".png,.jpg,.jpeg">
          </div>

          <input type="submit" name="addBtn" value="Update" class="btn btn-primary"></input>
        </form>
      </div>
    <?php
    }
    ?>
  </div>
  <?php
  require './partials/scripts.php';
  ?>
  <script src="./assets/vendor/simplemde/js/simplemde.min.js"></script>
  <script>
    ! function(e) {
      "use strict";

      function i() {}
      i.prototype.init = function() {
        new SimpleMDE({
          element: document.getElementById("description"),
          spellChecker: !1,
          forceSync: true,
          autosave: {
            enabled: !0,
            unique_id: "description"
          }
        })
      }, e.SimpleMDEEditor = new i, e.SimpleMDEEditor.Constructor = i
    }(window.jQuery),
    function() {
      "use strict";
      window.jQuery.SimpleMDEEditor.init()
    }();
  </script>
</body>

</html>