<?php
$host = "localhost";
$db   = "student_system";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
    "mysql:host=$host;port=3307;dbname=$db;charset=utf8",
    $user,
    $pass
);
} catch (PDOException $e) {
    die("Database connection failed");
}
