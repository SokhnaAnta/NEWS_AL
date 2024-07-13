<?php
$servername = "localhost";
$username = "mglsi_user";
$password = "passer";
$dbname = "mglsi_news";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

