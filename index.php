<?php
require('./database/connection.php');
require('./partials/variables.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage | Blogs</title>
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

    <div class="py-3 d-flex justify-content-end">
      <a href="create.php" class="btn btn-success rounded-0"> Add New Blog</a>
    </div>

    <?php
    // fetch data from the database
    $sql = "SELECT id, title, description,image, DATE_FORMAT(updated_at, '%Y-%m-%d %H:%i:%s') AS updated_at FROM posts;";
    $posts = $connection->query($sql);
    if ($posts) {
    ?>
      <table class="table table-centered mb-0">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Updated At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($posts as $post) {
          ?>
            <tr>
              <th scope="row"><?php echo $post['id'] ?></th>
              <?php
              if (isset($post['image']) && $post['image']) {
              ?>
                <td><img src="<?php echo $app_path ;?><?php echo $post['image'] ?>" alt="<?php echo $post['title'] ?>" class="rounded" width="150px" height="auto"></td>
              <?php
              } else {
              ?>
                <td>NULL</td>
              <?php
              }
              ?>
              <td><?php echo $post['title'] ?></td>
              <td><?php echo $post['updated_at'] ?></td>
              <td>
                <a href="./show.php?id=<?php echo $post['id']  ?>" class="btn btn-primary text-white"><i class="dripicons-preview"></i></a>
                <a href="./edit.php?id=<?php echo $post['id']  ?>" class="btn btn-warning text-white"><i class="dripicons-pencil"></i></a>
                <form action="./controllers/delete.php" method="POST">
                  <input type="hidden" value="<?php echo $post['id'] ?>" name="id">
                  <button type="submit" value="" class="btn btn-danger text-white"><i class=' dripicons-trash'></i></button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    <?php
    } else {
      echo "Error";
    }
    ?>
  </div>
</body>

</html>