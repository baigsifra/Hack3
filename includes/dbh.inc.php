<?php

$serverName = "localhost";
$dbUsername = "root";
$dBPassword = "hy1sunaf";
$dbName = "hack3";

$conn = mysqli_connect($serverName, $dbUsername, $dBPassword, $dbName);

if (!$conn) {
  die("Connection failed: " .mysqli_connect_error());
}
