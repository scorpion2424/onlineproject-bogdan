<?php
$servername = "localhost:3306";
$username = "root";
$password = "Etc3t3r4";

try {
$conn = new PDO("mysql:host=$servername;dbname=shop", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
?>