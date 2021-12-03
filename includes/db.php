<?php
$dbUsername = "root";
$dbPassword = "";

//Create connection
try {
    $conn = new PDO('mysql:dbname=4WW3;host=localhost;charset=utf8', $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die("Connection to database failed" . $err->getMessage());
}

