<?php
session_start();
require_once "../config/database.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username == "" || $password == "") $error = "All fields required";
    else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header("Location: ../dashboard.php");
            exit;
        } else $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
</head>
<body>
<div class="login-container">
    <h1 class="system-title">STUDENT INFORMATION MANAGEMENT SYSTEM</h1
    <h2>Login</h2>
    <?php if($error) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <label><input type="checkbox" id="showPass" onclick="togglePassword('password','showPass')"> Show Password</label>
        <div class="button-group">
            <button type="submit">Login</button>
            <a href="signup.php"><button type="button">Sign Up</button></a>
        </div>
    </form>
</div>

</body>
</html>
    