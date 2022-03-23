<?php
require('../partials/session.php');
require('../database/connection.php');
require('../partials/variables.php');

$id = $_POST['id'];

$message = '';

$sql = "SELECT * FROM `posts` WHERE id=" . $id . ";";
$post = mysqli_query($connection, $sql);

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
