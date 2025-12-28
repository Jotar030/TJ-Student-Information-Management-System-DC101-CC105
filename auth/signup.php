<?php
session_start();
require_once "../config/database.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username == "" || $password == "") $error = "All fields required";
    else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");
        try {
            $stmt->execute([$username,$hash]);
            $_SESSION['user'] = $username;
            header("Location: ../dashboard.php");
            exit;
        } catch(PDOException $e) {
            $error = "Username already exists";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
</head>
<body>
<div class="signup-container">
    <h1 class="system-title">STUDENT INFORMATION MANAGEMENT SYSTEM</h1
    <h2>Sign Up</h2>
    <?php if($error) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <label><input type="checkbox" id="showPass" onclick="togglePassword('password','showPass')"> Show Password</label>
        <div class="button-group">
            <button type="submit">Sign Up</button>
            <a href="login.php"><button type="button">Login</button></a>
        </div>
    </form>
</div>
</body>
</html>
