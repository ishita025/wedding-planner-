<!-- connect.php -->
<?php

$host = "saas-db.ct8mii42wcvp.ap-south-1.rds.amazonaws.com"; // RDS endpoint
$username = "admin"; // Replace with your database username
$password = "ishitagupta"; // Replace with your database password
$dbname = "saas-db"; // Replace with your database name

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

