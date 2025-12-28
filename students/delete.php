session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once "../config/database.php";
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once "../config/database.php";

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
