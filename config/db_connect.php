<?php
// Connect to the MySQL database
$conn = mysqli_connect('localhost', 'root', '', 'bincom');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}