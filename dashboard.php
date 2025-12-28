=<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
require_once "config/database.php";

$stmt = $conn->prepare("SELECT first_name, middle_name, last_name, student_number, mobile_number, address, course, section, year_level FROM students ORDER BY id DESC LIMIT 5");
$stmt->execute();
$recentStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <div class="page-wrapper">

        <div class="navbar">
            <div class="logo">Student System</div>
            <div class="links">
                <a href="dashboard.php">Dashboard</a>
                <a href="students/index.php">Student List</a>
                <a href="students/add.php">Add Student</a>
                <a href="auth/logout.php" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
                </div>
        </div>

        <div class="container">
            <h2>Dashboard</h2>

                <section style="margin-top:30px;">
                    <h3>About This Website</h3>
                    <p>
                   HI, I'M TJ G. BUENAOBRA FROM BSCS 2E, THIS IS MY WEBSITE "STUDENT INFORMATION MANAGEMENT".
                    IF YOU WANT TO ADD YOUR NAME KINDLY CLICK "ADD STUDENTS" TO ORGANIZED YOUR SECTIONS, AND YOUR COURSE.
                    </p>
                </section>

        <section style="margin-top:40px;">
            <h3>Recently Added Students</h3>
                <?php if(count($recentStudents) > 0): ?>
                    <table>
                    <tr>
                        <th>Full Name</th>
                        <th>Student Number</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th>Section</th>
                        <th>Year Level</th>
                    </tr>
                    <?php foreach($recentStudents as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['first_name'] . ' ' . $s['middle_name'] . ' ' . $s['last_name']) ?></td>
                            <td><?= htmlspecialchars($s['student_number']) ?></td>
                            <td><?= htmlspecialchars($s['mobile_number']) ?></td>
                            <td><?= htmlspecialchars($s['address']) ?></td>
                            <td><?= htmlspecialchars($s['course']) ?></td>
                            <td><?= htmlspecialchars($s['section']) ?></td>
                            <td><?= htmlspecialchars($s['year_level']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                <?php else: ?>
            <p>No students added yet.</p>
        <?php endif; ?>
        </section>
        
        </div>

        <footer class="footer">
        © Copyright TJ G. BUENAOBRA BSCS 2E
        </footer>
    </div>
</body>
</html>
