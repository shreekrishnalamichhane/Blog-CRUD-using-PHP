<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create | Blogs</title>
  <?php
  require './partials/styles.php';
  ?>
  <link rel="stylesheet" href="./assets/vendor/simplemde/css/simplemde.min.css">
</head>

<body>
  <div class="container">
    <?php
    require './partials/navbar.php';
    ?>
    <form method="POST" action="./controllers/store.php" class="py-5 mx-5 px-5" enctype="multipart/form-data">
      <h2 class="pb-3">Add New Blog</h2>
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title here." required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Your content here." rows="5" required></textarea>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <br>
        <input type="file" name="image" id="image" accept=".png,.jpg,.jpeg" required>
      </div>

      <input type="submit" name="addBtn" value="Add" class="btn btn-primary"></input>
    </form>
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