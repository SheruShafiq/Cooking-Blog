<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mydatabase';
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

try {
	$conn = new PDO($dsn, $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
?>
