<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "onlinetest";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection Failed" . $conn->connect_error);
}
