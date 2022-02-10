<?php
require('../partials/session.php');
require('../database/connection.php');
$title = $_POST['title'];
$description = $_POST['description'];

//File Upload
$message = '';
if (isset($_POST['addBtn']) && $_POST['addBtn'] == 'Add') {
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileType = $_FILES['image']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'png', 'jpeg');

    if (in_array($fileExtension, $allowedfileExtensions)) {
      // directory in which the uploaded file will be moved
      $uploadFileDir = '../storage/';
      $dest_path = $uploadFileDir . $newFileName;

      if (move_uploaded_file($fileTmpPath, $dest_path)) {
        // $message = 'File is successfully uploaded.';
      } else {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    } else {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  } else {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['image']['error'];
  }
  $sql = "INSERT INTO `posts` (`title`, `description`,`image`) VALUES ('" . $title . "','" . $description . "','" . $dest_path . "');";
}

// die($sql);


$result = mysqli_query($connection, $sql);
if ($result) {
  $message .= 'New Post Created Successfully.';
} else {
  $message .= `Couldn't Create A New Post.`;
}
$_SESSION['message'] = $message;
$connection->close();
header("Location: ../index.php");
