<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/database.php";
$error = $success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = trim($_POST['first_name']);
    $middle = trim($_POST['middle_name']);
    $last = trim($_POST['last_name']);
    $student_no = trim($_POST['student_number']);
    $mobile = trim($_POST['mobile_number']);
    $address = trim($_POST['address']);
    $course = trim($_POST['course']);
    $section = trim($_POST['section']);
    $year = trim($_POST['year_level']);

    if ($first=="" || $last=="" || $student_no=="" || $mobile=="" || $address=="" || $course=="" || $section=="" || $year=="") {
        $error = "Please fill in all required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (first_name,middle_name,last_name,student_number,mobile_number,address,course,section,year_level) VALUES (?,?,?,?,?,?,?,?,?)");
        try {
            $stmt->execute([$first,$middle,$last,$student_no,$mobile,$address,$course,$section,$year]);
            $success = "Student added successfully!";
        } catch(PDOException $e) {
            $error = "Student number already exists.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
</head>
<body>

<div class="navbar">
    <div class="logo">Student System</div>
    <div class="links">
        <a href="../dashboard.php">Dashboard</a>
        <a href="index.php">Student List</a>
        <a href="add.php">Add Student</a>
        <a href="../auth/logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Add Student</h2>

    <?php if($error) echo "<p style='color:red'>$error</p>"; ?>
    <?php if($success) echo "<p style='color:green'>$success</p>"; ?>

    <form method="post">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="middle_name" placeholder="Middle Name (optional)">
        <input type="text" name="last_name" placeholder="Last Name" required>

        <input type="text" name="student_number" placeholder="Student Number (*****-**-****)" required>
        <input type="text" name="mobile_number" placeholder="Mobile Number" required>
        <input type="text" name="address" placeholder="Address" required>

        <input type="text" name="course" placeholder="Course" required>
        <select name="section" required>
            <?php foreach(range('A','M') as $s) echo "<option value='$s'>$s</option>"; ?>
        </select>
        <select name="year_level" required>
            <option value="1st">1st Year</option>
            <option value="2nd">2nd Year</option>
            <option value="3rd">3rd Year</option>
            <option value="4th">4th Year</option>
        </select>

        <div class="button-group">
            <button type="submit">Add Student</button>
            <a href="index.php"><button type="button">Back to Student List</button></a>
        </div>
    </form>
</div>


</body>
</html>
