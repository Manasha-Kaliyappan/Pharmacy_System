<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy_system");

$query = "
    SELECT r.id, r.medicine_name, r.reason, r.requested_at, u.name AS username
    FROM medicine_requests r
    JOIN users u ON r.user_id = u.id
    ORDER BY r.requested_at DESC
";


$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Requested Medicines</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 40px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        h2 {
            text-align: center;
        }
        a {
            color: #3498db;
            display: block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📦 Requested Medicines</h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Requested By</th>
                <th>Medicine Name</th>
                <th>Reason</th>
                <th>Requested At</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['medicine_name']) ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td><?= htmlspecialchars($row['requested_at']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No medicine requests found.</p>
    <?php endif; ?>
    <a href="admin_dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
