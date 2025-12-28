<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/database.php";

$stmt = $conn->prepare("SELECT * FROM students ORDER BY id DESC");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
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
    <h2>Student List</h2>

    <div class="table-responsive">
        <table>
            <tr>
                <th>Full Name</th>
                <th>Student Number</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Course</th>
                <th>Section</th>
                <th>Year Level</th>
                <th>Actions</th>
            </tr>
            <?php if(count($students) > 0): ?>
                <?php foreach($students as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['first_name'] . ' ' . $s['middle_name'] . ' ' . $s['last_name']) ?></td>
                    <td><?= htmlspecialchars($s['student_number']) ?></td>
                    <td><?= htmlspecialchars($s['mobile_number']) ?></td>
                    <td><?= htmlspecialchars($s['address']) ?></td>
                    <td><?= htmlspecialchars($s['course']) ?></td>
                    <td><?= htmlspecialchars($s['section']) ?></td>
                    <td><?= htmlspecialchars($s['year_level']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $s['id'] ?>">Edit</a> |
                        <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" style="text-align:center;">No students found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>

</body>
</html>
