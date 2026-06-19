<?php
$mysqli = new mysqli("localhost", "root", "", "ci4", 3307);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
echo "Connected successfully!";
$mysqli->close();
?>