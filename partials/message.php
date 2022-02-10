<?php
session_start();
if (isset($_SESSION['message']) && $_SESSION['message']) {
  echo '<p class="alert alert-primary">' . $_SESSION['message'] . '</p>';
  unset($_SESSION['message']);
}
