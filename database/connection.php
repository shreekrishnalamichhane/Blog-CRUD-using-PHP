<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "phpblog";

// Create connection
$connection = new mysqli($host, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
} else {
    // echo "Connection Successful";
}
