<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once "../config/database.php";

$id = $_GET['id'] ?? '';
if(!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

$error = $success = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $error = "Please fill all required fields.";
    } else {
        $stmt2 = $conn->prepare("UPDATE students SET first_name=?, middle_name=?, last_name=?, student_number=?, mobile_number=?, address=?, course=?, section=?, year_level=? WHERE id=?");
        try {
            $stmt2->execute([$first,$middle,$last,$student_no,$mobile,$address,$course,$section,$year,$id]);
            $success = "Student updated successfully!";
        } catch(PDOException $e) {
            $error = "Student number already exists.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="navbar">
    <div class="logo">Student System</div>
    <div class="links">
        <a href="../dashboard.php">Dashboard</a>
        <a href="index.php">Student List</a>
        <a href="add.php">Add Student</a>
        <a href="../auth/logout.php" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Edit Student</h2>
    <?php if($error) echo "<p style='color:red'>$error</p>"; ?>
    <?php if($success) echo "<p style='color:green'>$success</p>"; ?>
    <form method="post">
        <input type="text" name="first_name" value="<?= htmlspecialchars($student['first_name']) ?>" placeholder="First Name" required>
        <input type="text" name="middle_name" value="<?= htmlspecialchars($student['middle_name']) ?>" placeholder="Middle Name (optional)">
        <input type="text" name="last_name" value="<?= htmlspecialchars($student['last_name']) ?>" placeholder="Last Name" required>

        <input type="text" name="student_number" value="<?= htmlspecialchars($student['student_number']) ?>" placeholder="Student Number (*****-**-****)" required>
        <input type="text" name="mobile_number" value="<?= htmlspecialchars($student['mobile_number']) ?>" placeholder="Mobile Number" required>
        <input type="text" name="address" value="<?= htmlspecialchars($student['address']) ?>" placeholder="Address" required>

        <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>" placeholder="Course" required>
        <select name="section" required>
            <?php foreach(range('A','M') as $s): ?>
                <option value="<?= $s ?>" <?= $student['section']==$s?'selected':'' ?>><?= $s ?></option>
            <?php endforeach; ?>
        </select>
        <select name="year_level" required>
            <option value="1st" <?= $student['year_level']=='1st'?'selected':'' ?>>1st Year</option>
            <option value="2nd" <?= $student['year_level']=='2nd'?'selected':'' ?>>2nd Year</option>
            <option value="3rd" <?= $student['year_level']=='3rd'?'selected':'' ?>>3rd Year</option>
            <option value="4th" <?= $student['year_level']=='4th'?'selected':'' ?>>4th Year</option>
        </select>

        <div class="button-group">
            <button type="submit">Update Student</button>
            <a href="index.php"><button type="button">Back to Student List</button></a>
        </div>
    </form>
</div>


</body>
</html>
