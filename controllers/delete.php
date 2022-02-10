<?php
require('../partials/session.php');
require('../database/connection.php');
$id = $_POST['id'];

$message = '';

$sql = "SELECT * FROM `posts` WHERE id=" . $id . ";";
$post = mysqli_query($connection, $sql);
if (mysqli_num_rows($post) > 0) {
  while ($row = mysqli_fetch_assoc($post)) {
    if (file_exists($row["image"])) {
      unlink($row["image"]);
      $message = 'Image Deleted Successfully.';
    }
  }
} else {
  $message = 'Image couldnot be deleted.';
}
$sql = "DELETE FROM `posts` WHERE id=" . $id . ";";

$result = $connection->query($sql);
if ($result) {
  echo "success";
  $message .= 'Post Deleted Successfully.';
} else {
  echo "Failed";
  $message .= 'Post Deletion Unsuccessful';
}
$connection->close();
$_SESSION['message'] = $message;
header("Location: ../index.php");
